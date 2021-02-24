<!--
dayコンポーネントに以下のような連想配列を渡したい。
(日付、モンスターの種類(タスク種類)、モンスターのステータス(タスク内容))
Fieldコンポーネントでは日付に応じdayコンポーネントを配置する。
Axiosでレコードをデータとして取出しVue.jsに渡すらしい?
参考>>https://reffect.co.jp/laravel/create-vue-laravel-environment#Axios
 -->

<template>
    <div class="field">
        <div class="my-area" :style="this.widthMyArea">
            <div class="range-menu">
                <a class="menu-top"
                v-on:click="switchRangeMenu">
                    範囲:{{ this.range }}日間
                </a>
                <ul v-if="this.rangeMenuIsActive">
                    <li v-on:click="changeRange(7)">7日間</li>
                    <li v-on:click="changeRange(30)">1ヶ月</li>
                </ul>
            </div>
            <div class="hero">
                <button v-on:click="this.switchMyMenu">open</button>
                <mymenu-component ref="myMenu">
                </mymenu-component>
            </div>
        </div>
        <div class="monsters-area" :style="this.widthMonstersArea">
            <taskmonsters-component
                :range="this.range"
                ref="teskMonsters">
            </taskmonsters-component>
        </div>
    </div>
</template>

<script>
export default {
    data: function(){
        return {
            width: 250,
            widthMyArea: '',
            widthMonstersArea: '',
            range: 7,
            rangeMenuIsActive: false,
        }
    },
    mounted: function(){
        this.widthMyArea = 'width: ' + this.width + 'px;',
        this.widthMonstersArea = 'width: calc(100% - ' + this.width + 'px);'
    },
    methods: {
        switchMyMenu: function(){
            this.$refs.myMenu.switch();
        },
        switchRangeMenu: function(){
            this.rangeMenuIsActive = !(this.rangeMenuIsActive);
        },
        changeRange: function(num){
            this.range = num;
            this.switchRangeMenu();
            this.$refs.teskMonsters.createMonsters(this.range);
            this.$refs.teskMonsters.setStyle(this.range);
        }
    }
}
</script>

<style lang="scss">
.field {
    height: auto;
    overflow: scroll;
    display: flex;
    .my-area {
        position: relative;
        background-color: #944;
        .range-menu {
            position: absolute;
            color: black;
            text-align: center;
            font-size: 16px;
            border:2px solid #333;
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
        .hero {
            position: absolute;
            top: 200px;
            left: 150px;
            width: 50px;
            height: 50px;
            background-color: #368;
            position: relative;
        }
    }
    .monsters-area {
        background-color: #386;
    }
}
</style>
