<template>
<div class="edit-tasks">
    <h2>タスク一覧</h2>
    <table class="task-list">
        <tr class="list-title">
            <th class=title-content>id</th>
            <th class=title-content>name</th>
            <th class=title-content>type</th>
            <th class=title-content>reword</th>
            <th class=title-content>limit</th>
        </tr>
        <tr class="list-item" v-for="task in this.tasks" v-bind:key="task.id">
            <td :style="style.item">{{ task.id }}</td>
            <td :style="style.item">{{ task.name }}</td>
            <td :style="style.item">{{ task.type }}</td>
            <td :style="style.item">{{ task.reword }}</td>
            <td :style="style.item">{{ task.limit }}</td>
            <td>
                <button class="button" v-on:click="1">更新</button>
                <button class="button" v-on:click="deleteTasks(task.id)">削除</button>
            </td>
            <!-- <td><HelloWorld ref="child"/></td> -->
        </tr>
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
        }
    }
}
</script>

<style lang="scss">
.task-list {
    border: 1px solid #000; 
    .list-title {
        width: 100%;
        // display:flex;
        padding:0px;
    .title-content {
        // width:  80px;
        height: 40px;
        background:orange;
        text-align: center;
        border-right:1px solid #ddd;
        font-size: 1.8rem;
        padding: 0 10px;
        &:last-child {
            border-right: none;
        }
    }    
    }
}
</style>