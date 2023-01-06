<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <link rel="shortcut icon" href="{{ url('/assets/front/assets/images/logo.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>فروشگاه اینترنتی </title>
    <!-- CSS Styles -->
    @include('Front::layouts.css-style')
    <!-- /CSS Styles -->
</head>
<body>
<!-- Header -->
<section id="header">
    <!-- Top NavBar -->
    @include('Front::layouts.top-navbar')
    <!-- /Top NavBar -->
    <!-- Search NavBar -->
    @include('Front::layouts.search-navbar')
    <!-- /Search NavBar -->
    <!-- Main NavBar -->
    @include('Front::layouts.main-navbar')
    <!-- Main NavBar -->
</section>
<!-- /Header -->

@yield('content')

@include('Front::layouts.footer')

<!-- Scripts -->
@include('sweetalert::alert')
@include('Front::layouts.scripts')
<!-- /Scripts -->
</body>
</html>
