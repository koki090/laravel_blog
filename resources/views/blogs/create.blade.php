@extends('layouts.logged_in')

@section('content')

<h1>{{ $title }}</h1>

<form method="post" action="{{ route('blogs.store') }}">
    @csrf
    <label>
        タイトル:
        <input type="text" name="title">
    </label>
    <label>
        内容:
        <input type="text" name="log">
    </label>
    <input type="submit" value="投稿">
</form>

@endsection

