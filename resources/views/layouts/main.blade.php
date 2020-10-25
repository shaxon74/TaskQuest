<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
</head>

<body>
    <nav class="navbar">
        <!-- アプリロゴ -->
        <a class='navbar-brand' href='/home'>TaskQuest</a>
        <!-- メニュー -->
        @guest
        @else
            <div 'navbar-menu'>
                <a class='menu-top'>{{ Auth::user()->name }}</a>
                <ul class='menu-list'>
                    <!-- ログアウトボタン -->
                    <li class='menu-item'>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                        Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        @endguest
    </nav>
    <div class="sidebar">
        <div class="sidebar-menu">
            <a>※タスク追加などのメニューを表示</a>
        </div>
    </div>
    <!-- コンテンツ -->
    <div class="content">
        @yield('content')
    </div>
</body>

<!-- Scripts -->
<script src=" {{ mix('js/main.js') }} "></script>
