<nav class="header">
    <!-- アプリロゴ -->
    <a class='navbar-brand' href='/home'>TaskQuest</a>
    <!-- メニュー -->
    <div 'navbar-menu'>
        @guest
            <ul class='menu-list'>
                <li class='menu-item'>
                    <a href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                <li class='menu-item'>
                    <a href="{{ route('register') }}">{{ __('register') }}</a>
                </li>
        @else
            <a class='menu-top'>{{ Auth::user()->name }}</a>
            <ul class='menu-list'>
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
