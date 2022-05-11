<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Meta -->
<meta property="og:title" content="A Basic HTML5 Template">
<meta property="og:type" content="website">
<meta property="og:url" content="https://www.sitepoint.com/a-basic-html5-template/">
<meta property="og:description" content="A simple HTML5 Template for new projects.">
<meta property="og:image" content="image.png">

<!-- Favicon -->
{{--    <link rel="icon" href="/favicon.ico">--}}
{{--    <link rel="icon" href="/favicon.svg" type="image/svg+xml">--}}
{{--    <link rel="apple-touch-icon" href="/apple-touch-icon.png">--}}

<!-- Global stylesheet-->
<link rel="stylesheet" href="{{ asset('css/app.css') }}"/>

<!-- Page stylesheets-->
@yield('stylesheets')
