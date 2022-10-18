@extends('Front::master')
@section('content')
    <section class="inner-page blog-inner-page" id="blog-page">
        <div class="container-fluid" id="page-hero">
            <div class="row">
                <div class="col-12">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 px-0">
                                <h1>{{ $post->title }}</h1>
                                <p>{{ substr( $post->summary , 0 , 1000)  }}</p>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="/">صفحه نخست</a></li>
                                        <li class="breadcrumb-item"><a href="{{ route('front.blog.index') }}">بلاگ آموزشی</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">{{ $post->title }}</li>
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
                                            <div class="row pt-2 px-3" id="post-title">
                                                <div class="col-12 col-md-8">
                                                    <h1>{{ $post->title }}</h1>
                                                </div>
                                                <div class="col-12 col-md-4 text-start text-md-end"><span class="date">ارسال شده در{{ $post->getShowDate() }}</span></div>
                                            </div>
                                            <hr>
                                            <div class="row py-0 px-3" id="post-details">
                                                <div class="col-8">
                                                    <span>دسته بندی: <a href="{{ route('front.blog.postCategory' , $post->category->slug) }}">{{ $post->category->name }}</a></span>
                                                </div>
                                                <div class="col-4 text-end"><span>
                                                        بازدید :
                                                        {{ $viewCount }}
                                                        |
                                                        نظر :
                                                        {{ $post->approvedComments()->count() }}
                                                    </span></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 pt-2 text-justify" id="post-html">
                                                    <div class="text-center pt-2 pb-3"><img src="{{ route('front.blog.image.show' , $post->id) }}" alt="{{ $post->id }}"></div>
                                                {!! $post->body !!}
                                                </div>
                                                <div class="col-12">
                                                    <hr>
                                                    <div id="keywords">
                                                        <span>برچسب ها:</span>
                                                            @foreach($post->tags as $tag)
                                                                <a href="{{ $post->tagPath($tag) }}"><span class="keyword">{{ $tag }}</span></a>
                                                            @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row pt-3 pb-4 pb-lg-0">
                                                <div class="col-12" id="share-links">
                                                    <span>به اشتراک بگذارید در:</span><br class="d-md-none">
                                                    <a href="#" target="_blank"><span class="share-link"><img src="assets/images/social/twitter.png" alt="توئیتر" height="25px"> توئیتر</span></a>
                                                    <a href="#" target="_blank"><span class="share-link"><img src="assets/images/social/facebook.png" alt="فیس بوک" height="25px"> فیس بوک</span></a>
                                                    <a href="#" target="_blank"><span class="share-link"><img src="assets/images/social/linkedin.png" alt="لینکدین" height="25px"> لینکدین</span></a>
                                                </div>
                                            </div>
                                            <hr>
                                            <!-- Comments -->
                                            @include('Front::partials.model-comments'  , ['model' => $post , 'type' => 'پست'])
                                            <!-- /Comments -->
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
