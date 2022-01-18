@extends('layouts.logged_in')

@section('content')

<h1>{{ $title }}</h1>
<ul>
    @forelse($recomend_users as $user)
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
    @if($blog->user_id === Auth::user()->id)
    <li>
        [<a href="{{ route('blogs.edit', $blog->id) }}">編集</a>]
        <form method="post" action="{{ route('blogs.destroy', $blog->id) }}" class="delete_form">
            @csrf
            @method('delete')
            <input type="submit" value="削除">
        </form>
    </li>
    @endif
    @empty
    <li>記録はまだありません</li>
    @endforelse
</ul>

@endsection

