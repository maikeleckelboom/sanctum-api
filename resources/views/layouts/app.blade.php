<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.head')
    <title>Server App | @yield('title')</title>
</head>
<body @yield('attrs')>
<div id="app">
    <main class="main">
        @yield('content')
    </main>
</div>
@include('partials.scripts')
@yield('scripts')
</body>
</html>
