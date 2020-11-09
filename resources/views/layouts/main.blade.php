<!doctype html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    @include('include.header')
    <div class="wrapper">
        <!-- コンテンツ -->
        <div class="content">
            @yield('content')
        </div>
        @auth
            @include('include.sidebar')
        @endauth
    </div>
    <script type="text/javascript" src="{{ mix('js/app.js') }}" ></script>
    @include('include.footer')
</body>
</html>
