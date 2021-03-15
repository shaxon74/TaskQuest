@extends('layouts.main')

@section('content')

<section class="App-section">
    <div id='app'>
        <main-component></main-component>
    </div>
</section>

<section class="task-list-section">
    <h2>タスク一覧</h2>
    <table class="task-list">
        <tr><th>name</th><th>type</th>
            <th>reword</th><th>is_finished</th></tr>
            @foreach ($tasks as $task)
                <tr>
                    <td>{{ $task->name }}</td>
                    <td>{{ limit_date($task->type) }}</td>
                    <td>{{ $task->reword }}</td>
                    <td>{{ $task->is_finished }}</td>
                </tr>
            @endforeach
    </table>
</section>

@endsection
