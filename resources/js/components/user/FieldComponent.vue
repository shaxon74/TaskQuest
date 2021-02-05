<!--
dayコンポーネントに以下のような連想配列を渡したい。
(日付、モンスターの種類(タスク種類)、モンスターのステータス(タスク内容))
Fieldコンポーネントでは日付に応じdayコンポーネントを配置する。
Axiosでレコードをデータとして取出しVue.jsに渡すらしい?
参考>>https://reffect.co.jp/laravel/create-vue-laravel-environment#Axios
 -->

<template>
    <div class="field">
        <div class="my-area" :style="this.width_my_area">
            <div class="hero">
            </div>
        </div>
        <div class="monsters-area" :style="this.width_monsters_area">
            <TaskMonsters-component></TaskMonsters-component>
        </div>
    </div>
</template>

<script>
export default {
    data: function(){
        return {
            width: 150,
            width_my_area: '',
            width_monsters_area: ''
        }
    },
    mounted: function(){
        this.width_my_area = 'width: ' + this.width + 'px;',
        this.width_monsters_area = 'width: calc(100% - ' + this.width + 'px);'
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
            // 位置決めのマージン
            // margin: 50px 20px 0 50px;
        }
    }
    .sporn-area {
        height: auto;
        background-color: #386;
    }
}
</style>
