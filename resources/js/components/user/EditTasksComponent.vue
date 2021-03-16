<template>
<div class="edit-tasks">
    <h2>タスク一覧</h2>
    <table class="task-list">
        <tr>
            <th>name</th>
            <th>type</th>
            <th>reword</th>
            <th>is_finished</th>
        </tr>
        <tr>
            <td>name</td>
            <td>type</td>
            <td>reword</td>
            <td>finished</td>
        </tr>
    </table>
</div>
</template>

<script>
export default {
    data: function() {
        return {
            tasks: []
        }
    },
    methods: {
        getTasks: function() {
            let tasks;
            axios.get('/tasks').then(response => {
                tasks = response.data.tasks;
            });
        }
    }
}
</script>

<style>

</style>