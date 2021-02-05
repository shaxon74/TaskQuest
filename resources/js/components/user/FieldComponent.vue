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
            <div class="hero">
                <button v-on:click="this.openMyMenu">open</button>
                <MyMenu-component
                    :style="visibility"
                    :is-active="this.isActive"
                    v-on:myMenuIsClosed="this.closeMyMenu">
                </MyMenu-component>
            </div>
        </div>
        <div class="monsters-area" :style="this.widthMonstersArea">
            <TaskMonsters-component></TaskMonsters-component>
        </div>
    </div>
</template>

<script>
export default {
    data: function(){
        return {
            width: 150,
            widthMyArea: '',
            widthMonstersArea: '',
            isActive: false,
            visibility: 'visibility: visible;'
        }
    },
    mounted: function(){
        this.widthMyArea = 'width: ' + this.width + 'px;',
        this.widthMonstersArea = 'width: calc(100% - ' + this.width + 'px);'
    },
    methods: {
        closeMyMenu: function(){
            this.isActive =false;
            this.switchMyMenu(this.isActive);
        },
        openMyMenu: function(){
            this.isActive =true;
            this.switchMyMenu(this.isActive);
        },
        switchMyMenu: function(isActive){
            isActive ?
            this.visibility = 'visibility: visible; ' :
            this.visibility = 'visibility: hidden; '
            console.log(this.visibility);
        }
    }
}
</script>

<style lang="scss">
.field {
    width: 100%;
    height: auto;
    overflow-x: scroll;
    display: flex;
    .my-area {
        height: 200px;
        position: relative;
        background-color: #944;
        .hero {
            position: absolute;
            top: 80px;
            left: 30px;
            width: 50px;
            height: 50px;
            background-color: #368;
            position: relative;
        }
    }
    .sporn-area {
        height: auto;
        background-color: #386;
    }
}
</style>
