<!--
dayコンポーネントに以下のような連想配列を渡したい。
(日付、モンスターの種類(タスク種類)、モンスターのステータス(タスク内容))
Fieldコンポーネントでは日付に応じdayコンポーネントを配置する。
Axiosでレコードをデータとして取出しVue.jsに渡すらしい?
参考>>https://reffect.co.jp/laravel/create-vue-laravel-environment#Axios
 -->

<template>
    <div class="field">
        <div class="sporn-area"
         v-bind:style="days_left">
            <div class="hero"></div>
            <day-component></day-component>
        </div>
    </div>
</template>

<script>
export default {
    data: function(){
        return {
            days_left: 'width: ' + 3000 + 'px',
        }
    }
}
</script>

<style lang="scss">
.test {font-size: 2rem;}
.field {
    width: 100%;
    overflow-x: scroll;
    .sporn-area {
        height: auto;
        background-color: #386;
        display: flex;
        .hero {
            flex: 0 0 50px;
            height: 50px;
            background-color: #368;
            // 位置決めのマージン
            margin: 50px 20px 0 50px;
        }
    }
}
</style>
