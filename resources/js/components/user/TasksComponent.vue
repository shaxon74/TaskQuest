<template>
    <div class="tasks">
        <a>タスクを登録</a>
        <div class="line"></div>
        <form class="task-form" action="/tasks/create" method="post">
            <input type="number" name= "user_id" value="1" style="display:none">
            <a>タスク名</a></br>
            <input v-model="name" placeholder="名前を入力"></br>
            <a>タスク種別</a></br>
            <select v-model="type">
                <option disabled value="">タスク種別を選択</option>
                <option>デイリー</option>
                <option>ウィークリー</option>
                <option>マンスリー</option>
                <option>日付選択</option>
            </select></br>
            <div v-if="this.type === '日付選択'">
                <a>日付</a></br>
                <input class="input-year" v-model="year" placeholder="">
                <a>年</a>
                <input class="input-month" v-model="month" placeholder="">
                <a>月</a>
                <input class="input-date" v-model="day" placeholder="">
                <a>日</a>
            </div>
            <a>報酬</a></br>
            <input v-model="reword" placeholder="報酬額を入力"></br>
            <button class="button" v-on:click="">登録</button>
        </form>
    </div>
</template>

<script>
export default {
    data: function(){
        return {
            name: '',
            type: '',
            year: '',
            month: '',
            day: '',
            reword: '',
        }
    },
    methods: {
        submit: function() {

        }
    }
}
</script>

<style lang="scss">
.tasks {
    margin: 10px 0;
    padding: 10px;
    width: 210px;
    font-size: 1.8rem;
    color: #333;
    border: 2px solid #bbb;
    border-radius:10px;
    .line {
        height: 0;
        border-top: 1px solid #666;
    }
    .task-form {
        a {
            font-size: 1.6rem;
        }
        input {
            width: 100%;
        }
        select {
            width: 100%;
        }
        .input-year {
            width: 38px;
        }
        .input-month, .input-date {
            width: 24px;
        }
        .button {
            width: auto;
            margin-top: 10px;
        }
    }
}
</style>
