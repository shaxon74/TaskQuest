<template>
<div class="main-component">
    <div class="app-display clearfix">
        <div class="scroll">
            <div class="field" :style="this.style">
                <entities-component
                    :range="this.range"
                    :tasks="this.tasks"
                    :doneTasks="this.doneTasks"
                    ref="teskMonsters"
                    v-on:displayMonsterInfo="displayMonsterInfo">
                </entities-component>
                <div class="range-menu">
                    <p class="menu-top" v-on:click="switchRangeMenu">
                        範囲:{{ this.range }}日間
                    </p>
                    <ul v-if="this.rangeMenuIsActive">
                        <li v-on:click="changeRange(7)">7日間</li>
                        <li v-on:click="changeRange(30)">1ヶ月</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="monster-info"v-show="monsterInfoisActive">
            <div class="card card-fix">
                <p class="card-header">{{ this.monsterInfo.name }}</p>
                <p class="card-body">報酬: {{ this.monsterInfo.reword }}</p>
                <p class="card-body">期限: {{ this.monsterInfo.dateLimit }}</p>
                <!-- <p class="card-body" v-if="this.monsterInfo.isDone">done: true</p>
                <p class="card-body" v-if="!this.monsterInfo.isDone">done: false</p> -->
            </div>
        </div>
    </div>
    <edittasks-component
        v-on:updateTask="this.updateMonsters"
        :tasks="this.tasks">
    </edittasks-component>
    <tasks-component v-on:addTask="this.updateMonsters">
    </tasks-component>
</div>
</template>

<script>
export default {
    data: function(){
        return {
            range: 7,
            rangeMenuIsActive: false,
            tasks: [],
            doneTasks: [],
            monsterInfo: [],
            monsterInfoisActive: false,
            style: 'width: 0px;',
        }
    },
    mounted: function(){
        this.updateMonsters();
        this.setStyle(this.range);
    },
    methods: {
        getTasks: async function() {
            await axios.get('/tasks', {
                params: {
                    reqDoneTasks: true
                }
            }).then(response => {
                this.tasks     = response.data.tasks;
                this.doneTasks = response.data.donetasks;
            });
        },
        changeRange: function(num){
            this.range = num;
            this.switchRangeMenu();
            this.setStyle(this.range);
            this.updateMonsters();
        },
        switchRangeMenu: function(){
            this.rangeMenuIsActive = !(this.rangeMenuIsActive);
        },
        setStyle: function(inRange){
            this.style = 'width: ' + (inRange*120 + 200) + 'px;';
        },
        updateMonsters: async function() {
            await this.getTasks();
            this.$refs.teskMonsters.createMonsters(this.range, this.tasks, this.doneTasks);
        },
        displayMonsterInfo: function(isActive, monster) {
            let dayjs = require('dayjs');
            if (isActive) {
                this.monsterInfo = monster;
                this.monsterInfo.dateLimit = 
                    dayjs(this.monsterInfo.dateLimit).format('YYYY-MM-DD');
            }else {
                this.monsterInfo = [];
            }
            this.monsterInfoisActive = isActive;
        },
        fotmat: function(date) {
            let dayjs = require('dayjs');
        }
    }
}
</script>

<style lang="scss">
.main-component {
    .app-display {
        margin: 0;
        padding: 0;
        position: relative;
        .scroll {
            width: 100%;
            overflow-x: scroll;
            border: 9px double #ddd;
            border-radius: 10px 10px 10px 10px;
            .field {
                height: 350px;
                background-color: #296;
                position: relative;
                .range-menu {
                    color: black;
                    text-align: center;
                    font-size: 16px;
                    border:2px solid #333;
                    position: absolute;
                    top: 0;
                    left: 0;
                    .menu-top {
                        display: inline-block;
                        width: 150px;
                        height: 40px;
                        margin: 0;
                        padding: 9px;
                        background-color: #bbb;
                        border-top:2px solid #fff;
                        border-bottom:2px solid #fff;
                    }
                    ul li{
                        width: 150px;
                        height: 40px;
                        padding-top: 9px;
                        background-color: #bbb;
                        border-bottom:2px solid #fff;
                    }
                }
            }
        }
        .monster-info {
            width: 200px;
            height: 350px;
            // display: none;
            background-color: rgba(3, 3, 3, 0.5);
            position: absolute;
            top: 9px;
            left: 9px;
            // left: calc(100% - 210px);
            padding: 50px 5px 0px 5px;
            .card-fix {
                width: 100%;
                opacity: 8;
                border: 6px double #bbb;
            background-color: #333;
                font-size: 1.4rem;
                p {
                    color: #fff;
                }
            }
        }
    }
}
</style>
