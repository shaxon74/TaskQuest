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
                <button v-on:click="this.switchMyMenu">open</button>
                <mymenu-component ref="MyMenu">
                </mymenu-component>
            </div>
        </div>
        <div class="monsters-area" :style="this.widthMonstersArea">
            <taskmonsters-component></taskmonsters-component>
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
        }
    },
    mounted: function(){
        this.widthMyArea = 'width: ' + this.width + 'px;',
        this.widthMonstersArea = 'width: calc(100% - ' + this.width + 'px);'
    },
    methods: {
        switchMyMenu: function(){
            this.$refs.MyMenu.switch();
        }
    }
}
</script>

<style lang="scss">
.field {
    width: 100%;
    height: auto;
    overflow: scroll;
    display: flex;
    .my-area {
        position: relative;
        background-color: #944;
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
