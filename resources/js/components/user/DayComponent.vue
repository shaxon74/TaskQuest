<template>
    <div class="days">
        <div class="date">
            <monster-component></monster-component>
        </div>
        <ul class="dbg">
            <li v-for="monster in monsters">{{ monster.name }}</li>
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
            days_length: 10,
            monsters: []
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
                console.log(tasks);
                var dayjs = require('dayjs');   // day.jsライブラリの呼出し
                var today = dayjs();
                var date_current = dayjs();     // for文でターゲットとしている日付
                var date_limit = dayjs();       // task.typeから判定したタスク期限
                // 表示する日付長だけmonsterデータを作成する。
                for(var cnt = 0; cnt < this.days_length; cnt++) {
                    date_current = today.add(cnt, 'day');
                    tasks.forEach(function( task ) {
                        switch(task.type){
                            case 1:
                            date_limit = date_current;
                            break;
                            case 2:
                            date_current.day() == 0 ?
                            date_limit = date_current :
                            date_limit = date_current.add( 7 - date_current.day(), 'day' );
                            break;
                            case 3:
                            date_limit = date_current.date(1).add(1, 'month' ).subtract(1, 'day');
                            break;
                        }
                        // taskからmonster連想配列を生成しmonsters配列にpushする。
                        if( date_limit.isSame(date_current) ){
                            console.log(task.name);
                            console.log(date_limit);
                            console.log(task.reword);
                            this.monsters.push({
                                'name':       task.name,
                                'date_limit': date_limit,
                                'reword':     task.reword});
                        }   // endif
                    }); // endforeach
                }   // endfor
                console.log('Monsters created!');
                console.log(this.monsters);
            });
        } // endfunction
    }
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
    }
</style>
