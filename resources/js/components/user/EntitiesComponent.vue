<template>
    <div class="TaskMonsters">
        <div class="hero">
            <button v-on:click="this.switchMyMenu">open</button>
            <mymenu-component ref="myMenu">
            </mymenu-component>
        </div>
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
                case 2:
                    dateLimitRet = 
                    dateCurrent.day() == 0 && task.day == 7 ?
                    dateCurrent :
                    dateCurrent.startOf('week').add(task.day, 'day');
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
        switchMyMenu: function(){
            this.$refs.myMenu.switch();
        },
    }   // endmethods
}
</script>

<style lang="scss">
    .TaskMonsters {
        width: 100%;
        height: 350px;
        position: relative;
    }
    .hero {
        position: absolute;
        top: 200px;
        left: 150px;
        width: 50px;
        height: 50px;
        background-color: #368;
        position: relative;
    }
</style>
