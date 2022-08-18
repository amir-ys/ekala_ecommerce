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
                                        <li class="breadcrumb-item"><a href="/">صفحه نخست</a></li>
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
                                                <div class="col"><h1 class="title">
                                                        پست ها با تگ
                                                        `{{  request()->route('tag') }}`
                                                    </h1></div>
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
                            <div class="col-12 col-lg-3">
                                <div class="row">
                                    <!-- Side Panel -->
                                    <div class="col-12 col-sm-6 col-lg-12 px-lg-2">
                                        <div class="blog-side-panel">
                                            <div class="row pt-2 px-3">
                                                <div class="col">
                                                    <div class="title">پربازدیدترین محصولات</div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="container">
                                                <div class="row">
                                                    <!-- Side Panel Product -->
                                                    <div class="col-12 col-lg-12 px-0 mt-2">
                                                        <a href="./product.html">
                                                            <div class="side-blog-product">
                                                                <div class="row pl-3">
                                                                    <div class="col-4 pl-2">
                                                                        <div class="image"
                                                                             style="background-image: url(assets/images/products/p100.png)"></div>
                                                                    </div>
                                                                    <div class="col-8 px-0">
                                                                        <h2>گوشی موبایل سامسونگ مدل Galaxy A51 دو سیم
                                                                            کارت</h2>
                                                                        <div class="row">
                                                                            <div class="col-8 pl-0">
                                                                                <span
                                                                                    class="price">3.200.000 تومان</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <!-- /Side Panel Product -->
                                                    <!-- Side Panel Product -->
                                                    <div class="col-12 col-lg-12 px-0 mt-2">
                                                        <a href="./product.html">
                                                            <div class="side-blog-product">
                                                                <div class="row pl-3">
                                                                    <div class="col-4 pl-2">
                                                                        <div class="image"
                                                                             style="background-image: url(assets/images/products/p200.png)"></div>
                                                                    </div>
                                                                    <div class="col-8 px-0">
                                                                        <h2>لپ تاپ 15 اینچی ایسوس مدل VivoBook
                                                                            X543MA-DM905</h2>
                                                                        <div class="row">
                                                                            <div class="col-8 pl-0">
                                                                                <span
                                                                                    class="price">3.200.000 تومان</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <!-- /Side Panel Product -->
                                                    <!-- Side Panel Product -->
                                                    <div class="col-12 col-lg-12 px-0 mt-2">
                                                        <a href="./product.html">
                                                            <div class="side-blog-product">
                                                                <div class="row pl-3">
                                                                    <div class="col-4 pl-2">
                                                                        <div class="image"
                                                                             style="background-image: url(assets/images/products/p300.png)"></div>
                                                                    </div>
                                                                    <div class="col-8 px-0">
                                                                        <h2>هدفون بی سیم سامسونگ مدل Galaxy Buds
                                                                            Live</h2>
                                                                        <div class="row">
                                                                            <div class="col-8 pl-0">
                                                                                <span
                                                                                    class="price">3.200.000 تومان</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <!-- /Side Panel Product -->
                                                    <!-- Side Panel Product -->
                                                    <div class="col-12 col-lg-12 px-0 mt-2">
                                                        <a href="./product.html">
                                                            <div class="side-blog-product">
                                                                <div class="row pl-3">
                                                                    <div class="col-4 pl-2">
                                                                        <div class="image"
                                                                             style="background-image: url(assets/images/products/p400.png)"></div>
                                                                    </div>
                                                                    <div class="col-8 px-0">
                                                                        <h2>دوربین دیجیتال کانن مدل EOS 2000D به همراه
                                                                            لنز
                                                                            18-55 میلی متر</h2>
                                                                        <div class="row">
                                                                            <div class="col-8 pl-0">
                                                                                <span
                                                                                    class="price">3.200.000 تومان</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <!-- /Side Panel Product -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-lg-12 px-lg-2">
                                        <div class="blog-side-panel">
                                            <div class="row pt-4 pt-sm-2 px-3">
                                                <div class="col">
                                                    <div class="title">پربازدیدترین مطالب</div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="container">
                                                <div class="row">
                                                    <!-- Side Panel Post -->
                                                    <div class="col-12 col-lg-12 px-0 mt-2">
                                                        <div class="side-blog-post">
                                                            <div class="row pl-3">
                                                                <div class="col-4 pl-2">
                                                                    <a href="./blog-post.html">
                                                                        <div class="image"
                                                                             style="background-image: url(assets/images/blog/post100.jpg)"></div>
                                                                    </a>
                                                                </div>
                                                                <div class="col-8 px-0">
                                                                    <a href="./blog-post.html"><h2>بررسی آیفون 12 پرو
                                                                            مکس
                                                                            اپل</h2></a>
                                                                    <div class="row">
                                                                        <div class="col-12 col-xl-6 pl-0">
                                                                        <span class="category">دسته بندی: <a
                                                                                href="./blog.html">اخبار</a></span>
                                                                        </div>
                                                                        <div
                                                                            class="col-12 col-xl-6 pr-0 text-start text-xl-end d-none d-xl-block">
                                                                            <span class="date">30 خرداد 1400</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /Side Panel Post -->
                                                    <!-- Side Panel Post -->
                                                    <div class="col-12 col-lg-12 px-0 mt-2">
                                                        <div class="side-blog-post">
                                                            <div class="row pl-3">
                                                                <div class="col-4 pl-2">
                                                                    <a href="./blog-post.html">
                                                                        <div class="image"
                                                                             style="background-image: url(assets/images/blog/post101.jpg)"></div>
                                                                    </a>
                                                                </div>
                                                                <div class="col-8 px-0">
                                                                    <a href="./blog-post.html"><h2>سامسونگ گلکسی S21
                                                                            اولترا
                                                                            5G</h2></a>
                                                                    <div class="row">
                                                                        <div class="col-12 col-xl-6 pl-0">
                                                                        <span class="category">دسته بندی: <a
                                                                                href="./blog.html">اخبار</a></span>
                                                                        </div>
                                                                        <div
                                                                            class="col-12 col-xl-6 pr-0 text-start text-xl-end d-none d-xl-block">
                                                                            <span class="date">30 خرداد 1400</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /Side Panel Post -->
                                                    <!-- Side Panel Post -->
                                                    <div class="col-12 col-lg-12 px-0 mt-2">
                                                        <div class="side-blog-post">
                                                            <div class="row pl-3">
                                                                <div class="col-4 pl-2">
                                                                    <a href="./blog-post.html">
                                                                        <div class="image"
                                                                             style="background-image: url(assets/images/blog/post102.jpg)"></div>
                                                                    </a>
                                                                </div>
                                                                <div class="col-8 px-0">
                                                                    <a href="./blog-post.html"><h2>دریافت گواهی بلوتوث
                                                                            گلکسی
                                                                            A03s سامسونگ</h2></a>
                                                                    <div class="row">
                                                                        <div class="col-12 col-xl-6 pl-0">
                                                                        <span class="category">دسته بندی: <a
                                                                                href="./blog.html">اخبار</a></span>
                                                                        </div>
                                                                        <div
                                                                            class="col-12 col-xl-6 pr-0 text-start text-xl-end d-none d-xl-block">
                                                                            <span class="date">30 خرداد 1400</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /Side Panel Post -->
                                                    <!-- Side Panel Post -->
                                                    <div class="col-12 col-lg-12 px-0 mt-2">
                                                        <div class="side-blog-post">
                                                            <div class="row pl-3">
                                                                <div class="col-4 pl-2">
                                                                    <a href="./blog-post.html">
                                                                        <div class="image"
                                                                             style="background-image: url(assets/images/blog/post103.jpg)"></div>
                                                                    </a>
                                                                </div>
                                                                <div class="col-8 px-0">
                                                                    <a href="./blog-post.html"><h2>خرابی نمایشگرهای سری
                                                                            گلکسی S20</h2></a>
                                                                    <div class="row">
                                                                        <div class="col-12 col-xl-6 pl-0">
                                                                        <span class="category">دسته بندی: <a
                                                                                href="./blog.html">اخبار</a></span>
                                                                        </div>
                                                                        <div
                                                                            class="col-12 col-xl-6 pr-0 text-start text-xl-end d-none d-xl-block">
                                                                            <span class="date">30 خرداد 1400</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /Side Panel Post -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Side Panel -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
