<template>
<div class="tasks">
    <a>タスクを登録</a>
    <div class="line"></div>
    <form class="task-form" action="/tasks/create" method="post">
        <a>タスク名</a></br>
        <a v-for="error in filt_error(0)">{{ error.message }}</a>
        <input v-model="name" placeholder="名前を入力"></br>
        <a>タスク種別</a></br>
        <a v-for="error in filt_error(1)">{{ error.message }}</a>
        <select v-model="type">
            <option v-for="option in options" v-bind:value="option.value">
                {{ option.text }}
            </option>
        </select></br>
        <div v-if="this.type == 4">
            <a>期限</a></br>
            <a v-for="error in filt_error(2)">{{ error.message }}</br></a>
            <input class="input-year" v-model="year" placeholder="">
            <a>年</a>
            <input class="input-month" v-model="month" placeholder="">
            <a>月</a>
            <input class="input-date" v-model="day" placeholder="">
            <a>日</a>
        </div>
        <a>報酬</a></br>
        <a v-for="error in filt_error(3)">{{ error.message }}</a>
        <input v-model="reword" placeholder="報酬額を入力"></br>
    </form>
        <button class="button" v-on:click="this.submit">登録</button>
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
            options: [
                { text: 'タスク種別を選択', value: '' },
                { text: 'デイリー', value: '1' },
                { text: 'ウィークリー', value: '2' },
                { text: 'マンスリー', value: '3' },
                { text: '日付選択', value: '4' }
            ],
            errors: [],
        }
    },
    methods: {
        submit: function() {
            let dayjs = require('dayjs');
            let limit_date = '';
            if (this.type == 4) {
                limit_date = dayjs().year(this.year)
                    .month(this.month-1)
                    .date(this.day)
                    .format('YYYY-MM-DD');
            }
            let axiosData = {
                name  : this.name,
                type  : this.type,
                limit : limit_date,
                reword: this.reword,
            };
            // console.log(axiosData);
            if ( this.check(axiosData) ) {
                axios.post('/tasks/create', axiosData)
                .then(response => {
                    console.log(response.data.message);
                    this.$emit('addTask');
                }).catch(error => {
                    console.log(error);
                });
            };
        },
        check: function(data) {
            this.errors = [];
            let dayjs = require('dayjs');
            //タスク名についてチェック
            if (data.name == '') {
                this.errors.push( {kind: 0, message: '・タスク名を入力してください。'} );
            }
            if (data.name.length > 100) {
                this.errors.push( {kind: 0, message: '・タスク名は200字以内としてください。'} );
            }
            //タスク種別についてチェック
            if (data.type == '' ) {
                this.errors.push( {kind: 1, message: '・タスク種別を設定してください。'} );
            }
            //タスク期限についてチェック(タスク種別4:指定日付の場合のみ行う)
            if (this.type == 4) {
                if ( (data.limit == '' || data.limit == '-1-11-30') ) {
                    this.errors.push( {kind: 2, message: '・日付を入力してください。'} );
                }
                if ( dayjs(data.limit, 'YYYY-MM-DD').isBefore(dayjs()) ) {
                    this.errors.push( {kind: 2, message: '・今日の日付より後を入力してください。'} );
                }
            }
            //報酬についてチェック
            if (data.reword <= 0) {
                this.errors.push( {kind: 3, message: '・報酬額を入力してください。'} );
            };
            // console.log(this.errors);
            return this.errors.length == 0 ? true : false;
        },
        filt_error: function(kind) {
            let errors_filted = this.errors.filter(x => x.kind === kind);
            return errors_filted;
        }
    }
}
</script>

<style lang="scss">
.tasks {
    margin: 10px 0;
    padding: 10px;
    width: 400px;
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
        .errors {
            font-size: 1.2rem;
            background-color: #faa

        }
    }
}
</style>
