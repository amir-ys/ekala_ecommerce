@extends('Front::master')
@section('content')
    <section class="inner-page" id="blog-page">
        <div class="container-fluid" id="page-hero">
            <div class="row">
                <div class="col-12">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 px-0">
                                <h1>بلاگ</h1>
                                <p>بلاگ آموزشی {{ site_name() }}</p>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="/blog">صفحه نخست</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">بلاگ آموزشی</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="content">
                        <div class="row">
                            <div class="col-12 col-lg-9">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="blog-container">
                                            <div class="row py-2 px-3">
                                                <div class="col"><h1 class="title">مرکز آموزش {{ site_name() }}</h1></div>
                                            </div>
                                            <div class="container px-2 pb-3">
                                                <div class="row row-cols-1 row-cols-md-2">
                                                    <!-- Blog Post -->
                                                    @foreach($posts as $post)
                                                        @include('Front::partials.blog-post-box' , ['post' => $post])
                                                    @endforeach
                                                    <!-- Blog Post -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @include('Front::blog._partials.sidebar')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
