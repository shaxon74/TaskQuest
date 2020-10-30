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
            @endif </tr>
    @endforeach
</table>
</ul>

@endsection
