<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>@yield('title')</title>
    </head>
    <body>
        @yield('header')
        @foreach($errors->all() as $error)
        <p class="error">{{ $error }}</p>
        @endforeach
        @if(session()->has('success'))
        <p class="success">{{ session()->get('success') }}</p>
        @endif
        @yield('content')
    </body>
</html>