@extends('layouts.default')

@section('header')

<header>
    <ul>
        <li>
            <a href="{{ route('blogs.create') }}">新規投稿</a>
        </li>
        <li>
            <a href="{{ route('users.show', Auth::id()) }}">{{ Auth::user()->name }}さんのプロフィール</a>
        </li>
        <li>
            <form method="post" action="{{ route('logout') }}">
                @csrf
                <input type="submit" value="ログアウト">
            </form>
        </li>
    </ul>
</header>

@endsection