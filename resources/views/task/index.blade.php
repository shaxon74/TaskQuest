@extends('layouts.main')

@section('content')
<a>登録されたタスクの詳細画面</a>
<table class="task-list">
    <tr><th>name</th><th>type</th>
        <th>reword</th><th>is_finished</th><th></th></tr>
    @foreach ($tasks as $task)
        <tr><td>{{ $task->name }}</td>
            <td>{{ limit_date($task->type) }}</td>
            <td>{{ $task->reword }}</td>
            <td>{{ $task->is_finished }}</td>
            @if ( $task->is_activated == true )
                <td><button type="button">edit</button></td>
            @endif
        </tr>
    @endforeach
</table>

<a>タスクを登録</a>
<form class="task_form">
    <table>
        <tr><th>name</th><td><input type="text" name="name"></td></tr>
        <tr><th>type</th><td><input type="number" name="type"></td></tr>
        <tr><th>reword</th><td><input type="number" name="number"></td></tr>
        <tr><th><input type="submit" name="button" value=" 追加"></th></tr>
    </table>
</form>

</ul>

@endsection
