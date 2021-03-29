@extends('layouts.main')

@section('content')
<div class="card">
    <div class="card-header">アカウント作成</div>
    <div class="line"></div>
    <div class="card-body">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <label for="name">ユーザ名</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div>
                <label for="email">メールアドレス</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div>
                <label for="password">パスワード</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div>
                <label for="password-confirm">パスワード(確認)</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>

            <div>
                <button type="submit">
                    送信
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
