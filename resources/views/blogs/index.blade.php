@extends('layouts.logged_in')

@section('content')

<h1>{{ $title }}</h1>

<ul>
    @forelse($blogs as $blog)
    <li>{{ $blog->title }}:{{ $blog->created_at }}</li>
    <li>
        {{ $blog->log }}
        [<a href="{{ route('blogs.edit', $blog->id) }}">編集</a>]
    </li>
    <li>
        <form method="post" action="{{ route('blogs.destroy', $blog->id) }}">
            @csrf
            @method('delete')
            <input type="submit" value="削除">
        </form>
    </li>
    @empty
    <li>記録はまだありません</li>
    @endforelse
</ul>

@endsection

