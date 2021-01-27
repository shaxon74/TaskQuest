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
            // ->moment.jsとかいうjsのライブラリが便利そう
            var today = new Date;
            var monsters = {};
            var date_current = new Date;
            var limit_date = new Date;
            var monster = ["id", "name", "date", "reword"];
            console.log("days_length: " + this.days_length);
            console.log(this.tasks);
            for(var cnt = 0; cnt < this.days_length; cnt++) {
                date_current.setDate(today.getDate() + cnt);
                console.log(date_current);
                //type=1だったら無条件でmonster作成。
                //type=2だったら週末のみmonster作成。
                //type=3だったら月末のみmonster作成。
                this.tasks.forEach(function( task ) {
                    switch(task.type){
                        case 1:
                            limit_date.setDate( date_current.getDate() );
                        case 2:
                            limit_date.setDate( date_current.getDate() + (7 - date_current.getDay()) );
                        case 3:
                        //月末日付をlimit_dateに入れる。
                    }
                    monster.name   = task.name;
                    monster.date   = limit_date;
                    monster.reword = task.reword;
                    // console.log(monster);
                });
            }
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
