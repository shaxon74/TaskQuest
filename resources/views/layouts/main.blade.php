<!doctype html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>

    <!-- CSRFトークン -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- スタイルシート -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>

<body>
    @include('include.header')
    <div class="main">
        @yield('content')
    </div>
    @include('include.footer')
    <script src=" {{ mix('js/app.js') }} "></script>
</body>
</html>
