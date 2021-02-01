<template>
    <div class="days">
        <div class="date">
            <monster-component></monster-component>
        </div>
        <ul class="dbg">
            <li v-for="monster in monsters">{{ monster }}</li>
        </ul>
        <!-- <ul class="dbg">
            <li v-for="task in tasks">{{ task }}</li>
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
                var tasks = response.data;
                var dayjs = require('dayjs');   // day.jsライブラリの呼出し
                var today = dayjs();
                var date_current = dayjs();     // for文でターゲットとしている日付
                var date_limit = dayjs();       // task.typeから判定したタスク期限
                // 表示する日付長だけmonsterデータを作成する。
                for(var cnt = 0; cnt < this.days_length; cnt++) {
                    date_current = today.add(cnt, 'day');
                    tasks.forEach( task => {
                        date_limit = this.func_date_limit(task.type, date_current);
                        // taskからmonster連想配列を生成しmonsters配列にpushする。
                        if( date_limit.isSame(date_current) ){
                            this.monsters.push({
                                'name':       task.name,
                                'date_limit': date_limit,
                                'reword':     task.reword});
                            }   // endif
                        }); // endforeach
                    }   // endfor
            }); // endaxios.get
        },  // endfunction
        func_date_limit: function(type, date_current) {
            var date_limit_ret;
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
    .days {
        position:relative;
        width: 100%;
        height: 200px;
        background-color: #295;
    }
    .date {
        position: absolute;
        left: 30px;
        width: 100px;
        height: 200px;
        background-color: #265;
    }
    .dbg {
        background: #814;
        margin-left: 100px;
    }
</style>
