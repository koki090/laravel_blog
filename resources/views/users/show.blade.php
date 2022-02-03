@extends('layouts.logged_in')

@section('content')

<h1>{{ $title }}</h1>
@if($user->image !== '')
<img src="{{ asset('storage/' . $user->image) }}">
@else
<img src="{{ asset('images/no_image.png') }}">
@endif
<dl>
    <dt>名前</dt>
    <dd>{{ $user->name }}</dd>
    @if($user->id === Auth::id())
    <dt>メールアドレス</dt>
    <dd>{{ $user->email }}</dd>
    <div>
        <a href="{{ route('users.edit', $user->id) }}">ユーザー情報を編集</a>
    </div>
</dl>
<ul>
    @forelse($follow_users as $follow_user)
    <li><a href="{{ route('users.show', $follow_user->id) }}">{{ $follow_user->name }}</a></li>
    <li>
        <form method="post" action="{{ route('users.follow', $follow_user->id) }}">
            @csrf
            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
            <input type="hidden" name="follow_id" value="{{ $follow_user->id }}">
            <input type="submit" value="{{ Auth::user()->isFollowUser($follow_user->id) ? 'フォロー解除' : 'フォローする' }}">
        </form>
    </li>
    @empty
    <li>フォローしているユーザーはいません。</li>
    @endforelse
</ul>
@else
</dl>
<form method="post" action="{{ route('users.follow', $user->id) }}">
    @csrf
    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
    <input type="hidden" name="follow_id" value="{{ $user->id }}">
    <input type="submit" value="{{ Auth::user()->isFollowUser($user->id) ? 'フォロー解除' : 'フォローする' }}">
</form>
@endif

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

@endsection