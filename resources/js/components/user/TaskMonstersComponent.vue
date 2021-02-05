<template>
    <div class="TaskMonsters" style="width: 3000px;">
        <monster-component
            v-for="monster in monsters"
            :key=monster.id
            :name=monster.id
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
            days_length: 10,
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
                let date_current = dayjs();     // for文でターゲットとしている日付
                let date_limit = dayjs();       // task.typeから判定したタスク期限
                let id = 0;
                let num_perday;
                // 表示する日付長だけmonsterデータを作成する。
                for(let cnt = 0; cnt < this.days_length; cnt++) {
                    num_perday = 0;
                    date_current = today.add(cnt, 'day');
                    tasks.forEach( task => {
                        date_limit = this.func_date_limit(task.type, date_current);
                        // taskからmonster連想配列を生成しmonsters配列にpushする。
                        if( date_limit.isSame(date_current) ){
                            this.monsters.push({
                                'id':         id,
                                'name':       task.name,
                                'date_limit': date_limit,
                                'num_perday': num_perday,
                                'reword':     task.reword});
                            id++;
                            num_perday++;
                        }   // endif
                    }); // endforeach
                }   // endfor
            }); // endaxios.get
        },  // endfunction
        func_date_limit: function(type, date_current) {
            let date_limit_ret;
            switch(type){
                case 1:
                date_limit_ret = date_current;
                break;
                case 2:
                date_current.day() == 0 ?
                date_limit_ret = date_current :
                date_limit_ret = date_current.add( 7 - date_current.day(), 'day' );
                break;
                case 3:
                date_limit_ret = date_current.date(1).add(1, 'month' ).subtract(1, 'day');
                break;
            }
            return date_limit_ret;
        }   // endfunction
    }   // endmethods
}
</script>

<style lang="scss">
    .TaskMonsters {
        position:relative;
        // width: 100%;
        height: 200px;
        background-color: #295;
    }
    .dbg {
        background: #814;
        margin-left: 100px;
    }
</style>
