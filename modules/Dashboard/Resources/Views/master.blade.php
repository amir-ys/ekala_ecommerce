<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>  پنل مدیریت |  @yield('title' , 'داشبرد') </title>
    @include('Dashboard::layouts.head-css')
    <!-- begin::theme color -->
    <meta name="theme-color" content="#3f51b5" />
    <!-- end::theme color -->
</head>
<body>

<!-- begin::page loader-->
<div class="page-loader">
    <div class="spinner-border"></div>
    <span>در حال بارگذاری ...</span>
</div>
<!-- end::page loader -->

<!-- begin::sidebar -->
@include('Dashboard::layouts.top-sidebar')
<!-- end::sidebar -->

<!-- begin::side menu -->
@include('Dashboard::layouts.sidebar')
<!-- end::side menu -->

<!-- begin::navbar -->
@include('Dashboard::layouts.navbar')
<!-- end::navbar -->

<!-- begin::main content -->
<main class="main-content">
    <div class="container-fluid">
        <!-- begin::page header -->
        <div class="page-header">
            @include('Dashboard::layouts.breadcrumb')
        </div>
        <!-- end::page header -->
        @yield('content')
    </div>
</main>
<!-- end::main content -->
@include('Dashboard::layouts.scripts')
</body>
<!-- Mirrored from v3dboy.ir/previews/html/gramos/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 16 Feb 2022 08:48:06 GMT -->
</html>
