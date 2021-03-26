<template>
<div class="edit-tasks">
    <table class="task-list">
        <a>タスク一覧</a>
        <div class="line"></div>
        <div class="list-item" v-for="task in futureTasks" v-bind:key="task.id">
            <a class="name" :style="style.item">{{ task.name }}</a>
            <a class="reword" :style="style.item">報酬:{{ task.reword }}G</a>
            <a class="limit" :style="style.item">{{ typeString(task) }}</a>
            <div class="button">
                <button v-on:click="1">更新</button>
                <button v-on:click="deleteTasks(task.id)">削除</button>
            </div>
        </div>
    </table>
</div>
</template>

<script>
export default {
    props: ['tasks'],
    data: function() {
        return {
            name: '',
            style: {
                item: {
                    display: 'default'
                },
                form: {
                    display: 'default'
                },
            },
        }
    },
    methods: {
        deleteTasks: function(id) {
            axios.delete('/tasks/delete', {
                params: {
                    id: id
                }
            }).then(response => {
                this.$emit('updateTask');
            }).catch(error => {
                console.log(error);
            });
        },
        typeString: function(task) {
            let dayjs = require('dayjs');
            let limit = '';
            let type = [
                { text: 'デイリー', value: 1 },
                { text: '毎週', value: 2 },
                { text: '月末', value: 3 },
                { text: '', value: 4 }
            ];
            let week = [
                { text: '月', value: 1 },
                { text: '火', value: 2 },
                { text: '水', value: 3 },
                { text: '木', value: 4 },
                { text: '金', value: 5 },
                { text: '土', value: 6 },
                { text: '日', value: 7 },
            ];
            switch(task.type) {
                case 2:
                    limit = week.find( w => w.value === task.day ).text + '曜日';
                break;
                case 4:
                    limit = dayjs(task.limit).format('YYYY/MM/DD');
                break;
            };
            return type.find( t => t.value === task.type ).text
            + limit;
        }
    },
    computed: {
        futureTasks: function() {
            let dayjs = require('dayjs');
            return this.tasks.filter( task => {
                return task.limit == null
                || dayjs().isBefore(dayjs(task.limit))
                || dayjs().isSame(dayjs(task.limit));
            });
        }
    }
}
</script>

<style lang="scss">
.task-list {
    margin-top: 10px;
    padding: 10px;
    width: 100%;
    border: 9px double #ddd; 
    border-radius: 10px 10px 10px 10px;
    font-size: 1.8rem;
    color: #fff;
    .line {
        height: 0;
        border-top: 3px solid #888;
    }
    .list-item {
        margin-top: 10px;
        margin-bottom: 16px;
        border-bottom: 1px solid #fff;
        display: flex;
        .name {
            margin-top:auto;
            width: 40%;
            font-size: 2rem;
        }
        .reword {
            margin-top:auto;
            width: 20%;
            min-width: 90px;
            font-size: 1.6rem;
        }
        .limit {
            margin-top:auto;
            width: 20%;
            min-width: 110px;
            font-size: 1.6rem;
        }
        .button {
            margin-top:auto;
            margin-bottom:auto;
            width: 20%;
            text-align: right;
        }
        &:last-child {
            margin-bottom: 0;
        }
    }
}
</style>