@extends('layouts.default')

@section('header')

<header>
    <ul>
        <li>
            <a href="{{ route('register') }}">会員登録</a>
        </li>
        <li>
            <a href="{{ route('login') }}">サインイン</a>
        </li>
    </ul>
</header>

@endsection