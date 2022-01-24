@extends('layouts.logged_in')

@section('content')

<h1>{{ $title }}</h1>

<form method="post" action="{{ route('users.update', $user->id) }}">
    @csrf
    @method('patch')
    <label>
        名前:
        <input type="text" name="name" value="{{ $user->name }}">
    </label>
    <label>
        メールアドレス:
        <input type="email" name="email" value="{{ $user->email }}">
    </label>
    <input type="submit" value="編集を保存">
</form>

@endsection