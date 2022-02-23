@extends('layouts.logged_in')

@section('content')

<form method="post" action="{{ route('blogs.search') }}">
    @csrf
    <input type="text" name="search_word" placeholder="検索ワードを入力">
    <input type="submit" value="検索">
</form>
<h1>{{ $title }}</h1>
<ul>
    @forelse($recommend_users as $user)
    @if($user->id !== Auth::user()->id)
    <li>
        <a href="{{ route('users.show', $user->id) }}">{{ $user->name }}</a>
        <form method="post" action="{{ route('users.follow', $user->id) }}">
            @csrf
            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
            <input type="hidden" name="follow_id" value="{{ $user->id }}">
            <input type="submit" value="フォローする">
        </form>
    </li>
    @endif
    @empty
    <li>ユーザーがいません。</li>
    @endforelse
</ul>
<ul>
    @forelse($blogs as $blog)
    <li>投稿者:{{ $blog->user->name }}</li>
    <li>{{ $blog->title }}:{{ $blog->created_at }}</li>
    <li>
        {{ $blog->log }}
    </li>
    <li>
        <ul>
            @forelse($blog->blogImages as $image)
            <li>
                <img src="{{ asset('storage/' . $image->image) }}">
            </li>
            @empty
            <li>
                <img src="{{ asset('images/no_image.png') }}">
            </li>
            @endforelse
        </ul>
    </li>
    @if($blog->user_id === Auth::user()->id)
    <li>
        [<a href="{{ route('blogs.edit_image', $blog->id) }}">画像を削除</a>]
        [<a href="{{ route('blogs.push_image', $blog->id) }}">画像を追加</a>]
        [<a href="{{ route('blogs.edit', $blog->id) }}">編集</a>]
        <form method="post" action="{{ route('blogs.destroy', $blog->id) }}" class="delete_form">
            @csrf
            @method('delete')
            <input type="submit" value="削除">
        </form>
    </li>
    @endif
    @empty
    <li>投稿はまだありません</li>
    @endforelse
</ul>

@endsection

