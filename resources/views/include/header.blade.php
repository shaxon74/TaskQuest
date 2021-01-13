<nav class="header clearfix">
    <!-- アプリロゴ -->
    <h1 class="logo">
        <a href='/home'>Task Quest</a>
    </h1>

    <!-- メニュー -->
    <ul class='header-menu'>
        @guest
            <!-- ログイン -->
            <li class='menu-item'>
                <a href="{{ route('login') }}">{{ __('Login') }}</a>
            </li><!--
            <新規登録>
            --><li class='menu-item'>
                <a href="{{ route('register') }}">{{ __('register') }}</a>
            </li>
　        　@else
            <!-- ユーザーページ -->
            <li class='menu-item' ><a href="/home">{{ Auth::user()->name }}</a></li><!--
            <ログアウトボタン>
            --><li class='menu-item'>
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                </form>
            </li>
        @endguest
    </ul>
</nav>
