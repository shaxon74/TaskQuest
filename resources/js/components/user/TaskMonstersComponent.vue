<template>
    <div class="TaskMonsters" style="width: 1200px;">
        <!-- <monster-component
            v-for="monster in monsters"
            :key=monster.key
            :monster="monster"
            :doneTasks="doneTasks">
        </monster-component> -->
    </div>
</template>

<script>
export default {
    data: function(){
        return {
            monsters: [],
            doneTasks: [],
            daysLength: 10,
        }
    },
    mounted: function(){
        this.createMonsters();
        this.getDoneTasks();
        // this.sleep(5000);
        console.log(this.monsters);
        console.log(this.doneTasks);
    },
    methods: {
        createMonsters: function(){
            // Axiosでレコードを取出す。
            axios.get('/axios/tasks').then(response => {
                let tasks = response.data;
                let dayjs = require('dayjs');   // day.jsライブラリの呼出し
                let today = dayjs();
                let dateCurrent = dayjs();     // for文でターゲットとしている日付
                let dateLimit = dayjs();       // task.typeから判定したタスク期限
                let key = 0;
                let numPerDay;
                // 表示する日付長だけmonsterデータを作成する。
                for(let cnt = 0; cnt < this.daysLength; cnt++) {
                    numPerDay = 0;
                    dateCurrent = today.add(cnt, 'day');
                    tasks.forEach( task => {
                        dateLimit = this.setDateLimit(task.type, dateCurrent);
                        // taskからmonster連想配列を生成しmonsters配列にpushする。
                        if( dateLimit.isSame(dateCurrent) ){
                            this.monsters.push({
                                'id':           task.id,
                                'name':         task.name,
                                'reword':       task.reword,
                                'finished':     task.finished,
                                'key':          key,
                                'dateLimit':    dateLimit,
                                'numPerDay':    numPerDay,
                            });
                            key++;
                            numPerDay++;
                        }   // endif
                    }); // endforeach
                }   // endfor
            }); // endaxios.get
        },  // endfunction
        setDateLimit: function(type, dateCurrent) {
            let dateLimit_ret;
            switch(type){
                case 1:
                dateLimit_ret = dateCurrent;
                break;
                case 2:
                dateCurrent.day() == 0 ?
                dateLimit_ret = dateCurrent :
                dateLimit_ret = dateCurrent.endOf('week').add(1, 'day');
                break;
                case 3:
                dateLimit_ret = dateCurrent.endOf('month');
                break;
            }
            return dateLimit_ret;
        },   // endfunction
        getDoneTasks: function() {
            axios.get('/axios/done_tasks').then(response => {
                // console.log('start: getDoneTasks');
                // console.log(response.data);
                this.doneTasks = response.data;
                // console.log(this.doneTasks);
                // console.log('end: getDoneTasks');
            });
        },
        // getDoneTasks: function() {
        //     const res = await axios.get('/axios/done_tasks');
        //     console.log(res.data);
        // },
        sleep: function(waitMsec) {
            var startMsec = new Date();
            // 指定ミリ秒間だけループさせる（CPUは常にビジー状態）
            while (new Date() - startMsec < waitMsec);
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
