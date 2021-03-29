<template>
<div class="main-component">
    <div class="app-display clearfix">
        <div class="scroll">
            <div class="field" :style="this.style">
                <entities-component
                    :range="this.range"
                    :tasks="this.tasks"
                    :doneTasks="this.doneTasks"
                    ref="teskMonsters">
                </entities-component>
                <div class="range-menu">
                    <a class="menu-top" v-on:click="switchRangeMenu">
                        範囲:{{ this.range }}日間
                    </a>
                    <ul v-if="this.rangeMenuIsActive">
                        <li v-on:click="changeRange(7)">7日間</li>
                        <li v-on:click="changeRange(30)">1ヶ月</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="menu">
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
            style: 'width: 1290px;',
        }
    },
    mounted: function(){
        this.updateMonsters();
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
        updateMonsters: async function() {
            await this.getTasks();
            this.$refs.teskMonsters.createMonsters(this.range, this.tasks, this.doneTasks);
        },
        setStyle: function(inRange){
            this.style = 'width: ' + (inRange*120 + 200 + 250) + 'px;';
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
                        padding-top: 6px;
                        background-color: #bbb;
                        border-top:2px solid #fff;
                        border-bottom:2px solid #fff;
                    }
                    ul li{
                        width: 150px;
                        height: 40px;
                        padding-top: 6px;
                        background-color: #bbb;
                        border-bottom:2px solid #fff;
                    }
                }
            }
        }
        .menu {
            width: 200px;
            height: 350px;
            // display: none;
            background-color: #555;
            opacity: 0.5;
            position: absolute;
            top: 9px;
            left: 9px;
            // left: calc(100% - 210px);
        }
    }
}
</style>
