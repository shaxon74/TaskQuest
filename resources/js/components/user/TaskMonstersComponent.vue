<template>
    <div class="TaskMonsters" style="width: 1200px;">
        <monster-component
            v-for="monster in monsters"
            :key=monster.key
            :monster="monster">
        </monster-component>
    </div>
</template>

<script>
export default {
    data: function(){
        return {
            monsters: [],
            daysLength: 2,
        }
    },
    mounted: async function(){
        await this.createMonsters();
        console.log('TaskMonsters mounted!!');
    },
    methods: {
        createMonsters: async function(){
            // Axiosでレコードを取出す。
            let dayjs = require('dayjs');   // day.jsライブラリの呼出し
            let today = dayjs();
            let dateCurrent = dayjs();     // for文でターゲットとしている日付
            let dateLimit = dayjs();       // task.typeから判定したタスク期限
            let key = 0;
            let numPerDay;
            let tasks;
            let doneTasks;
            await axios.get('/axios/tasks').then(response => {
                tasks     = response.data.tasks;
                doneTasks = response.data.donetasks;
            }); // endaxios.get
            // console.log(tasks);
            // console.log(doneTasks);
            // 表示する日付長だけmonsterデータを作成する。
            for(let cnt = 0; cnt < this.daysLength; cnt++) {
                numPerDay = 0;
                dateCurrent = today.add(cnt, 'day').startOf('day');
                tasks.forEach( task => {
                    dateLimit = this.setDateLimit(task.type, dateCurrent)
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
                            'is_done'   : this.setDoneTask(doneTasks, task.id, dateLimit)
                        });
                        key++;
                        numPerDay++;
                    }   // endif
                }); // endforeach
            }   // endfor
            console.log('createMonsters');
            console.log(this.monsters);
        },  // endfunction
        setDateLimit: function(type, dateCurrent) {
            let dateLimit_ret;
            switch(type){
                case 1: dateLimit_ret = dateCurrent;
                break;
                case 2: dateLimit_ret = dateCurrent.day() == 0 ?
                            dateCurrent :
                            dateCurrent.endOf('week').add(1, 'day');
                break;
                case 3: dateLimit_ret = dateCurrent.endOf('month');
                break;
            }
            return dateLimit_ret;
        },
        setDoneTask: function(doneTasks, task_id, dateLimit){
            const doneTask = doneTasks.filter(item =>
                item.task_id === task_id
                && item.date_limit === dateLimit.format('YYYY-MM-DD 00:00:00')
            ).shift();
            // console.log( doneTask );
            return doneTask != undefined ? doneTask.is_done : 0;
        }
    }   // endmethods
}
</script>

<style lang="scss">
    .TaskMonsters {
        position:relative;
        height: 350px;
        background-color: #295;
    }
    .dbg {
        background: #814;
        margin-left: 100px;
    }
</style>
