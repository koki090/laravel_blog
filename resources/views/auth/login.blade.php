@extends('layouts.not_logged_in')

@section('content')

<h1>ログイン画面</h1>
<form method="post" action="{{ route('login') }}">
    @csrf
    <label>
        メールアドレス:
        <input type="email" name="email">
    </label>
    <label>
        パスワード:
        <input type="password" name="password">
    </label>
    <input type="submit" value="ログイン">
</form>

@endsection