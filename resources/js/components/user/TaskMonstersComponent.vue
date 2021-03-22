<template>
    <div class="TaskMonsters">
        <monster-component
            v-for="monster in monsters"
            :key=monster.key
            :monster="monster">
        </monster-component>
    </div>
</template>

<script>
export default {
    props: [
        'range',
        'tasks',
        'doneTasks',
    ],
    data: function(){
        return {
            monsters: [],
            styleWidth: '',
        }
    },
    mounted: async function(){
        this.setStyle(7);
    },
    methods: {
        createMonsters: function(daysLength, tasks, doneTasks){
            // Axiosでレコードを取出す。
            let dayjs = require('dayjs');   // day.jsライブラリの呼出し
            let today = dayjs();
            let dateCurrent = dayjs();      // for文でターゲットとしている日付
            let dateLimit = dayjs();        // task.typeから判定したタスク期限
            let id = 0;
            let numPerDay;
            this.monsters = [];
            if (tasks.length == 0) return;
            // 表示する日付長だけmonsterデータを作成する。
            for(let cnt = 0; cnt < daysLength; cnt++) {
                numPerDay = 0;
                dateCurrent = today.add(cnt, 'day').startOf('day');
                tasks.forEach( task => {
                    dateLimit = this.setDateLimit(task, dateCurrent)
                                    .startOf('day');
                    // taskからmonster連想配列を生成しmonsters配列にpushする。
                    if( dateLimit.isSame(dateCurrent) ){
                        this.monsters.push({
                            'taskId'    : task.id,
                            'name'      : task.name,
                            'reword'    : task.reword,
                            'id'        : id,
                            'dateLimit' : dateLimit,
                            'numPerDay' : numPerDay,
                            'isDone'    : this.setDoneTask(doneTasks, task.id, dateLimit)
                        });
                        id++;
                        numPerDay++;
                    }   // endif
                }); // endforeach
            }   // endfor
        },  // endfunction
        setDateLimit: function(task, dateCurrent) {
            let dayjs = require('dayjs');
            let dateLimitRet;
            switch(task.type){
                case 1: dateLimitRet = dateCurrent;
                break;
                case 2: dateLimitRet = dateCurrent.day() == 0 ?
                            dateCurrent :
                            dateCurrent.endOf('week').add(1, 'day');
                break;
                case 3: dateLimitRet = dateCurrent.endOf('month');
                break;
                case 4: dateLimitRet = dayjs(task.limit);
                break;
            }
            return dateLimitRet;
        },
        setDoneTask: function(doneTasks, taskId, dateLimit){
            const doneTask = doneTasks.filter(item =>
                item.task_id === taskId
                && item.date_limit === dateLimit.format('YYYY-MM-DD 00:00:00')
            ).shift();
            return doneTask != undefined ? doneTask.is_done : 0;
        },
        setStyle: function(inRange){
            this.styleWidth = 'width: ' + (inRange*120 + 200) + 'px;';
        }
    }   // endmethods
}
</script>

<style lang="scss">
    .TaskMonsters {
        position:relative;
        background-color: #295;
    }
    .dbg {
        background: #814;
        margin-left: 100px;
    }
</style>
