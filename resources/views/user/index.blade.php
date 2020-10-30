@extends('layouts.main')

@section('content')
<a>現在進行中のタスク、ユーザー情報などの表示</a>
<div id="app">
    <original-component></original-component>
</div>
<table class="task-list">
    <tr><th>name</th><th>type</th>
        <th>reword</th><th>is_finished</th></tr>
    @foreach ($tasks as $task)
        <tr><td>{{ $task->name }}</td>
            <td>{{ limit_date($task->type) }}</td>
            <td>{{ $task->reword }}</td>
            <td>{{ $task->is_finished }}</td>
    @endforeach
</table>

@endsection
