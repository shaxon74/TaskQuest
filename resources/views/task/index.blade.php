@extends('layouts.main')

@section('content')
<a>登録されたタスクの詳細画面</a>
{{ config('const.TEST') }}
<table class="task-list">
    <tr><th>name</th><th>期限</th><th>type</th>
        <th>reword</th><th>is_finished</th><th></th></tr>
    @foreach ($tasks as $task)
        <tr><td>{{ $task->name }}</td>
            <td>{{ limit_date($task->type) }}</td>
            <td>{{ config('const.TASK_TYPE')[$task->type] }}</td>
            <td>{{ $task->reword }}</td>
            <td>{{ $task->is_finished }}</td>
            @if ( $task->is_activated == true )
                <td><button type="button">edit</button></td>
            @endif
        </tr>
    @endforeach
</table>

<a>タスクを登録</a>
<form class="task_form" action="/tasks/create" method="post">
    @csrf
    <input type="number" name= "user_id" value="{{ Auth::user()->id }}" style="display:none">
    <table>
        <tr><th>name</th><td><input type="text" name="name"></td></tr>
        <tr><th>type</th><td>
            <select name="type">
                <option value="1">デイリー</option>
                <option value="2">ウィークリー</option>
                <option value="3">マンスリー</option>
                <!-- <option value="4">特定日付</option> -->
            </select></td></tr>
        <tr><th>reword</th><td><input type="number" name="reword"></td></tr>
        <tr><th><input type="submit" value=" 追加"></th></tr>
    </table>
</form>

</ul>

@endsection
