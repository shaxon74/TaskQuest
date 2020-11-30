<nav class="header clearfix">
    <!-- アプリロゴ -->
    <h1 class="logo">
        <a href='/home'>Task Quest</a>
    </h1>

    <!-- メニュー -->
    <div class='header-menu'>
        @guest
            <ul>
                <li class='menu-item'>
                    <a href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                <li class='menu-item'>
                    <a href="{{ route('register') }}">{{ __('register') }}</a>
                </li>
        @else
            <ul>
                <li class='menu-item' ><a href="/home">{{ Auth::user()->name }}</a></li>
                <!-- ログアウトボタン -->
                <li class='menu-item'>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                    </form>
                </li>
            </ul>
        @endguest
    </div>
</nav>
