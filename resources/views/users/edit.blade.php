@extends('layouts.logged_in')

@section('content')

<h1>{{ $title }}</h1>
@if($user->image !== '')
<img src="{{ asset('storage/' . $user->image) }}">
@else
<img src="{{ asset('images/no_image.png') }}">
@endif
<form method="post" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
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
    <label>
        プロフィール:
        <input type="text" name="profile" value="{{ $user->profile }}">
    </label>
    <label>
        画像:
        <input type="file" name="image">
    </label>
    <input type="submit" value="編集を保存">
</form>

@endsection