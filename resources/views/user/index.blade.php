@extends('layouts.main')

@section('content')

<section class="task-list">
    <h2>map</h2>
    <div class="field">
        <div class="sporn-area">
            <div class="hero"></div>
            <div class="day1">
                <div class="monster"></div>
            </div>
            <div class="day1">
                <div class="monster"></div>
            </div>
            <div class="day1">
                <div class="monster"></div>
            </div>
            <div class="day1">
                <div class="monster"></div>
            </div>
            <div class="day1">
                <div class="monster"></div>
            </div>
        </div>
    </div>

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

<section class="vue-test">
    <h2>Vue.jsテスト</h2>
    <div id="app">
        <original-component></original-component>
    </div>
</section>

@endsection
