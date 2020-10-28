@extends('layouts.main')

@section('content')
<a>現在進行中のタスク、ユーザー情報などの表示</a>
<!-- <div id='compdemo'>
    <original-component></original-component>
</div> -->
<div id="app">
    <original-component></original-component>
    <!-- <example-component></example-component> -->
</div>
<ul>
    @foreach ($tasks as $task)
        <li>
            <a>{{ $task->id }} | {{ $task->name }}</a>
        </li>
    @endforeach
</ul>

@endsection
