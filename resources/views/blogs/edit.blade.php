@extends('layouts.logged_in')

@section('content')

<h1>{{ $title }}</h1>

<form method="post" action="{{ route('blogs.update', $blog->id) }}">
    @csrf
    @method('patch')
    <label>
        タイトル:
        <input type="text" name="title" value="{{ $blog->title }}">
    </label>
    <label>
        内容:
        <input type="text" name="log" value="{{ $blog->log }}">
    </label>
    <input type="submit" value="編集を完了">
</form>

@endsection

