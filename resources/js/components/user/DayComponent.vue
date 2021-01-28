<template>
    <div class="days">
        <div class="date">
            <monster-component></monster-component>
        </div>
        <button v-on:click="monsters">test</button>
        <ul class="dbg">
            <li v-for="task in tasks">{{ task }}</li>
        </ul>
    </div>
</template>

<script>
export default {
    data: function(){
        return {
            tasks: [],
            days_length: 10
        }
    },
    mounted: function(){
        axios.get('/tasks_axios').then(response => this.tasks = response.data)
    },
    methods: {
        next_weekend: function(){
            console.log("hello!");
        },
        monsters: function(tasks){
            //日付処理が余りにもクソ面倒(月跨ぎのときは特に)
            // ->day.jsとかいうjsのライブラリが便利そう
            var dayjs = require('dayjs');
            var today = dayjs();
            var monsters = [];
            var date_current = dayjs();
            var date_limit = dayjs();
            var monster = {};
            // console.log( 'today: ' + today.format('YYYY/MM/DD') );
            // console.log('days_length: ' + this.days_length);
            // console.log(this.tasks);
            for(var cnt = 0; cnt < this.days_length; cnt++) {
                date_current = today.add(cnt, 'day');
                // console.log( 'date_current: ' + date_current.format('YYYY/MM/DD') );
                this.tasks.forEach(function( task ) {
                    // console.log( 'task.type: ' + task.type );
                    switch(task.type){
                        case 1:
                            console.log( 'task.type: ' + task.type );
                            date_limit = date_current;
                            break;
                        case 2:
                            console.log( 'task.type: ' + task.type );
                            date_current.day() == 0 ?
                                date_limit = date_current :
                                date_limit = date_current.add( 7 - date_current.day(), 'day' );
                            break;
                        case 3:
                            console.log( 'task.type: ' + task.type );
                            date_limit = date_current.date(1).add(1, 'month' ).subtract(1, 'day');
                            break;
                    }
                    console.log( 'date_limit: ' + date_limit.format('YYYY/MM/DD') );
                    if( date_limit.isSame(date_current) ){
                        monster.name       = task.name;
                        monster.date_limit = date_limit;
                        monster.reword     = task.reword;
                        console.log(monster.name);
                        console.log(monster.date_limit);
                        console.log(monster.reword);
                        monsters.push(monster);
                        // console.log(dayjs(monster.date_limit).format('YYYY/MM/DD'));
                    }
                });
            }
            console.log(monsters);
        }
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
