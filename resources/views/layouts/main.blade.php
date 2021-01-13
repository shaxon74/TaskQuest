<!doctype html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>


    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>

<body>
    @include('include.header')
    <div class="wrapper clearfix">
        <!-- コンテンツ -->
        <div class="content">
            @yield('content')
        </div>
        @include('include.sidemenu')
    </div>
    <script type="text/javascript" src="{{ mix('js/app.js') }}" ></script>
    @include('include.footer')
</body>
</html>
