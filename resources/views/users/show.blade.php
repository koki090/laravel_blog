@extends('layouts.logged_in')

@section('content')

<h1>{{ $title }}</h1>

<dl>
    <dt>名前</dt>
    <dd>{{ $user->name }}</dd>
    @if($user->id === Auth::id())
    <dt>メールアドレス</dt>
    <dd>{{ $user->email }}</dd>
    <div>
        <a href="{{ route('users.edit', $user->id) }}">ユーザー情報を編集</a>
    </div>
    @endif
</dl>

@endsection