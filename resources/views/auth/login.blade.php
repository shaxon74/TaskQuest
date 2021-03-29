@extends('layouts.main')

@section('content')
<div class="card">
    <div class="card-header">ログイン</div>
    <div class="card-body">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <label for="email">メールアドレス</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div>
                <label for="password">パスワード</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        ログイン情報を記録する
                    </label>
                </div>
            </div>

            <div>
                <button type="submit">
                    ログイン
                </button>

                @if (Route::has('password.request'))
                    <a class="link" href="{{ route('password.request') }}">
                        パスワードを忘れた場合
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>
@endsection
