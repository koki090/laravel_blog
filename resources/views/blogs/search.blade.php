@extends('layouts.logged_in')

@section('content')

<form method="post" action="{{ route('blogs.search') }}">
    @csrf
    <input type="text" name="search_word" placeholder="検索ワードを入力" value="{{ $search_word }}">
    <input type="submit" value="検索">
</form>

<h1>{{ $title }}</h1>

<ul>
    @forelse($search_blogs as $blog)
    <li>投稿者:{{ $blog->user->name }}</li>
    <li>{{ $blog->title }}:{{ $blog->created_at }}</li>
    <li>
        {{ $blog->log }}
    </li>
    @empty
    <li>検索に該当する投稿はありませんでした。</li>
    @endforelse
</ul>

@endsection