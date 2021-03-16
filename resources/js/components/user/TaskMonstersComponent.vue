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
        'done_tasks',
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
        createMonsters: function(daysLength, tasks, done_tasks){
            // Axiosでレコードを取出す。
            let dayjs = require('dayjs');   // day.jsライブラリの呼出し
            let today = dayjs();
            let dateCurrent = dayjs();      // for文でターゲットとしている日付
            let dateLimit = dayjs();        // task.typeから判定したタスク期限
            let key = 0;
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
                            'id'        : task.id,
                            'name'      : task.name,
                            'reword'    : task.reword,
                            'finished'  : task.finished,
                            'key'       : key,
                            'dateLimit' : dateLimit,
                            'numPerDay' : numPerDay,
                            'is_done'   : this.setDoneTask(done_tasks, task.id, dateLimit)
                        });
                        key++;
                        numPerDay++;
                    }   // endif
                }); // endforeach
            }   // endfor
        },  // endfunction
        setDateLimit: function(task, dateCurrent) {
            let dayjs = require('dayjs');
            let dateLimit_ret;
            switch(task.type){
                case 1: dateLimit_ret = dateCurrent;
                break;
                case 2: dateLimit_ret = dateCurrent.day() == 0 ?
                            dateCurrent :
                            dateCurrent.endOf('week').add(1, 'day');
                break;
                case 3: dateLimit_ret = dateCurrent.endOf('month');
                break;
                case 4: dateLimit_ret = dayjs(task.limit);
                break;
            }
            return dateLimit_ret;
        },
        setDoneTask: function(doneTasks, task_id, dateLimit){
            const doneTask = doneTasks.filter(item =>
                item.task_id === task_id
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
