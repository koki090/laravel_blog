@extends('layouts.not_logged_in')

@section('content')

<h1>会員登録画面</h1>
<form method="post" action="{{ route('register') }}">
    @csrf
    <label>
        名前:
        <input type="name" name="name">
    </label>
    <label>
        メールアドレス:
        <input type="email" name="email">
    </label>
    <label>
        パスワード:
        <input type="password" name="password">
    </label>
    <label>
        パスワード（再確認）:
        <input type="password" name="password_confirmation">
    </label>
    <input type="submit" value="登録">
</form>

@endsection