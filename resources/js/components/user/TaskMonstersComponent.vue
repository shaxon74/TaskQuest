<template>
    <div class="TaskMonsters" style="width: 1000px;">
        <monster-component
            v-for="monster in monsters"
            :key=monster.key
            :monster="monster">
        </monster-component>
        <!-- <ul class="dbg">
            <li v-for="monster in monsters">{{ monster }}</li>
        </ul> -->
    </div>
</template>

<script>
export default {
    data: function(){
        return {
            monsters: [],
            daysLength: 10,
        }
    },
    mounted: function(){
        this.create_monsters();
    },
    methods: {
        create_monsters: function(){
            // Axiosでレコードを取出す。
            axios.get('/tasks_axios').then(response => {
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
        }   // endfunction
    }   // endmethods
}
</script>

<style lang="scss">
    .TaskMonsters {
        position:relative;
        // width: 100%;
        height: 100%;
        background-color: #295;
    }
    .dbg {
        background: #814;
        margin-left: 100px;
    }
</style>
