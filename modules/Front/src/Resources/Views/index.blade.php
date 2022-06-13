@extends('Front::master')
@section('content')
    <!-- Slider Section -->
    <section id="slider" class="mt-3">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-9" data-aos="fade-zoom-in" data-aos-duration="700">
                    <div id="carouselExampleCaptions" class="carousel slide carousel-fade" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="/assets/front/assets/images/slider/slide1.jpg" class="d-block" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="/assets/front/assets/images/slider/slide2.jpg" class="d-block" alt="...">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                <div class="col-12 col-md-3 mt-2 mt-sm-1 text-center text-sm-start">
                    <div class="row row-cols-1 row-cols-sm-3 row-cols-md-1 h-100 gy-2 g-sm-1 g-md-0">
                        @foreach($topBanners as $topBanner)
                        <div class="col align-self-start" data-aos="fade-top" data-aos-duration="1000">
                            <a href="{{ $topBanner->link }}">
                                <img src="{{ route('front.images.show' , [\Modules\Slide\Models\Slide::getUploadDir() , $topBanner->photo]) }}"
                                     alt="" width="100%">
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Slider Section -->

    <!-- Featured Products Section -->
    <section id="featured-products" class="my-5">
        <div class="container">
            <!-- Tabs -->
            <div class="row pb-2 pb-sm-4">
                <div class="col-12 text-center">
                    <div class="btn-group" role="group" id="featured-products-nav">
                        <button type="button" class="btn active featured-categories" data-val="featured">محصولات منتخب</button>
                        <button type="button" class="btn featured-categories" data-val="on-sale">تخفیف خورده</button>
                        <button type="button" class="btn featured-categories" data-val="most-visited">پربازدیدترین</button>
                    </div>
                </div>
            </div>
            <!-- /Tabs -->

            <!-- Products -->
            <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-md-4 featured-product featured" data-aos="fade-up" data-aos-duration="1000">
                @foreach($products as $product)
                    <div class="col" >
                    @include('Front::partials.product-box' , ['product' => $product , 'discount' => false])
                    </div>
                @endforeach
            </div>

            <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-md-4 featured-product on-sale">
                @foreach($products as $product)
                <div class="col">
                    @include('Front::partials.product-box' , ['product' => $product , 'discount' => true])
                </div>
                @endforeach
            </div>

            <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-md-4 featured-product most-visited">
                @foreach($products as $product)
                    <div class="col" >
                        @include('Front::partials.product-box' , ['product' => $product , 'discount' => false])
                    </div>
                @endforeach
            </div>
            <!-- /Products -->
        </div>
    </section>
    <!-- /Featured Products Section -->

    <!-- On Sale Products -->
    <section id="on-sale-products" class="py-5 mt-5">
        <h1 class="section-title">فروش ویژه</h1>
        <div class="section-subtitle">محصولات دارای تخفیف ویژه به مدت محدود</div>
        <div class="container pt-4">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="on-sale-product-box h-100 p-3" data-aos="fade-zoom-in" data-aos-duration="800">
                        <div class="row h-100">
                            <div class="col-12 col-sm-4 col-lg-5">
                                <a href="./product.html"><div class="image h-100" style="background-image: url('/assets/front/assets/images/products/p1000.png')"></div></a>
                            </div>
                            <div class="col-12 col-sm-8 col-lg-7 py-3">
                                <div class="box-title">محصول ویژه امروز</div>
                                <div class="box-subtitle">فروش به مدت محدود</div>
                                <a href="./product.html">
                                    <div class="product-title pt-4">گوشی موبایل سامسونگ مدل Galaxy A51 دو سیم کارت</div>
                                </a>
                                <div class="price py-2">
                                    <span class="discounted">4.500.000 تومان</span>
                                    <br class="d-sm-none">
                                    <span class="pre">4.800.000 تومان</span>
                                </div>
                                <div class="cta pt-2">
                                    <a href="./product.html" class="hvr-icon-back">همین حالا بخرید <i class="fa fa-arrow-left hvr-icon"></i></a>
                                </div>
                                <div class="counter mt-3">
                                    <div class="time-counter">
                                        <div class="seconds count">
                                            <div class="num">30</div>
                                            <div class="label">ثانیه</div>
                                        </div>
                                        <div class="minutes count">
                                            <div class="num">59</div>
                                            <div class="label">دقیقه</div>
                                        </div>
                                        <div class="hours count">
                                            <div class="num">13</div>
                                            <div class="label">ساعت</div>
                                        </div>
                                        <div class="days count">
                                            <div class="num">38</div>
                                            <div class="label">روز</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <!-- Product Box -->
                    <div class="product-box">
                        <a href="./product.html">
                            <div class="image" style="background-image: url('/assets/front/assets/images/products/p303.png')">
                                <span class="badge on-sale-badge">فروش ویژه</span>
                            </div>
                        </a>
                        <div class="details p-3">
                            <div class="category">
                                <a href="./products.html">گوشی موبایل</a>
                                &nbsp;/&nbsp;
                                <a href="./products.html">سامسونگ</a>
                            </div>
                            <a href="./product.html"><h2>مودم روتر ADSL2 Plus بی‌ سیم N300 دی-لینک مدل DSL-2740U</h2></a>
                            <div>
                                <span class="discounted">4.500.000 تومان</span>
                                <br class="d-sm-none">
                                <span class="price">4.800.000 تومان</span>
                            </div>
                            <div class="rate">
                                <i class="fa fa-star-half-alt"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <span class="reviews">(14 رای دهنده)</span>
                            </div>
                        </div>
                    </div>
                    <!-- /Product Box -->
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <!-- Product Box -->
                    <div class="product-box">
                        <a href="./product.html">
                            <div class="image" style="background-image: url('/assets/front/assets/images/products/p403.png')">
                                <span class="badge on-sale-badge">فروش ویژه</span>
                            </div>
                        </a>
                        <div class="details p-3">
                            <div class="category">
                                <a href="./products.html">گوشی موبایل</a>
                                &nbsp;/&nbsp;
                                <a href="./products.html">سامسونگ</a>
                            </div>
                            <a href="./product.html"><h2>دوربین دیجیتال مدل AX6065</h2></a>
                            <div>
                                <span class="discounted">4.500.000 تومان</span>
                                <br class="d-sm-none">
                                <span class="price">4.800.000 تومان</span>
                            </div>
                            <div class="rate">
                                <i class="fa fa-star-half-alt"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <span class="reviews">(14 رای دهنده)</span>
                            </div>
                        </div>
                    </div>
                    <!-- /Product Box -->
                </div>
            </div>
        </div>
    </section>
    <!-- /On Sale Products -->

    <!-- Benefits Section -->
    <section id="benefits" class="pt-4">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 gy-3 text-center">
                <div class="col" data-aos="fade-zoom-in" data-aos-duration="800">
                    <img src="/assets/front/assets/images/benefits/benefit1.png" alt="">
                    <span>پشتیبانی 24 ساعته</span>
                </div>
                <div class="col" data-aos="fade-zoom-in" data-aos-duration="1000">
                    <img src="/assets/front/assets/images/benefits/benefit2.png" alt="">
                    <span>ضمانت اصالت کالا</span>
                </div>
                <div class="col" data-aos="fade-zoom-in" data-aos-duration="1200">
                    <img src="/assets/front/assets/images/benefits/benefit3.png" alt="">
                    <span>ضمانت بازگشت وجه</span>
                </div>
                <div class="col" data-aos="fade-zoom-in" data-aos-duration="1400">
                    <img src="/assets/front/assets/images/benefits/benefit4.png" alt="">
                    <span>ارسال سریع و رایگان</span>
                </div>
            </div>
            <div class="row pt-2">
                <div class="col">
                    <hr>
                </div>
            </div>
        </div>
    </section>
    <!-- /Benefits Section -->

    <!-- Most Sales Products -->
    <section id="most-sales-products" class="pt-4">
        <h1 class="section-title">پرفروش ترین محصولات</h1>
        <div class="container pt-4">



            <!-- Products -->
            <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-md-4 most-sales-product" data-aos="fade-up" data-aos-duration="1000">
                @foreach($products as $product)
                    <div class="col" >
                        @include('Front::partials.product-box' , ['product' => $product , 'discount' => false])
                    </div>
                @endforeach
            </div>
            <!-- /Products -->
        </div>
    </section>
    <hr>
    <!-- /Most Sales Products -->

    <!-- Promo Images -->
    <div class="container" data-aos="fade-up" data-aos-duration="1200">
        <div class="row">
            @foreach($bottomBanners as $bottomBanner)
            <div class="col-12 col-md-6 pt-2 text-center">
                <a href="{{ $bottomBanner->link }}">
                    <img style="height:150px;width: 700px" src="{{ route('front.images.show' , [\Modules\Slide\Models\Slide::getUploadDir() , $bottomBanner->photo]) }}" alt="">
                </a>
            </div>
            @endforeach
        </div>
    </div>
    <!-- /Promo Images -->

    <!-- Blog Section -->
    <section id="blog" class="pt-5">
        <h1 class="section-title">جدیدترین مقالات آموزشی</h1>
        <div class="container pt-4">
            <div class="row row-cols-1 row-cols-md-3">
                <!-- Blog Post -->
                <div class="col">
                    <div class="blog-post-box" data-aos="fade-up" data-aos-duration="1000">
                        <a href="./blog-post.html"><div class="post-image" style="background-image: url('/assets/front/assets/images/blog/post100.jpg')"></div></a>
                        <div class="details py-3 px-4">
                            <div class="post-date">ارسال شده در 30 خرداد 1400</div>
                            <a href="./blog-post.html">
                                <h2 class="post-title">بررسی آیفون 12 پرو مکس اپل</h2>
                            </a>
                            <a href="./blog-post.html">
                                <div class="post-description">آیفون ۱۲ پرو مکس با ابعاد غول‌پیکر، دوربین توانمندتر و باتری حجمیش، تمام‌عیارترین پرچم‌دار کنونی اپل به‌حساب می‌آید.</div>
                            </a>
                            <div class="read-more"><a href="./blog-post.html" class="hvr-icon-back">بیشتر خوانید <i class="fa fa-arrow-left hvr-icon"></i></a></div>
                        </div>
                    </div>
                </div>
                <!-- Blog Post -->
                <!-- /Blog Post -->
                <div class="col">
                    <div class="blog-post-box" data-aos="fade-up" data-aos-duration="1000">
                        <a href="./blog-post.html"><div class="post-image" style="background-image: url('/assets/front/assets/images/blog/post101.jpg')"></div></a>
                        <div class="details py-3 px-4">
                            <div class="post-date">ارسال شده در 30 خرداد 1400</div>
                            <a href="./blog-post.html">
                                <h2 class="post-title">سامسونگ گلکسی S21 اولترا 5G</h2>
                            </a>
                            <a href="./blog-post.html">
                                <div class="post-description">سامسونگ برای گوشی پرچم‌دارش، یعنی گلکسی S21 اولترا 5G، علاوه‌بر رنگ‌های قبلی، رنگ جدید سرمه‌ای را معرفی کرد.</div>
                            </a>
                            <div class="read-more"><a href="./blog-post.html" class="hvr-icon-back">بیشتر خوانید <i class="fa fa-arrow-left hvr-icon"></i></a></div>
                        </div>
                    </div>
                </div>
                <!-- Blog Post -->
                <!-- /Blog Post -->
                <div class="col">
                    <div class="blog-post-box" data-aos="fade-up" data-aos-duration="1000">
                        <a href="./blog-post.html"><div class="post-image" style="background-image: url('/assets/front/assets/images/blog/post102.jpg')"></div></a>
                        <div class="details py-3 px-4">
                            <div class="post-date">ارسال شده در 30 خرداد 1400</div>
                            <a href="./blog-post.html">
                                <h2 class="post-title">دریافت گواهی بلوتوث گلکسی A03s سامسونگ</h2>
                            </a>
                            <a href="./blog-post.html">
                                <div class="post-description">ماه گذشته، برای اولین‌بار اطلاعاتی از گلکسی A03s فاش شد و اکنون با دریافت گواهی بلوتوث، به زمان رونمایی این گوشی نزدیک شده‌ایم.</div>
                            </a>
                            <div class="read-more"><a href="./blog-post.html" class="hvr-icon-back">بیشتر خوانید <i class="fa fa-arrow-left hvr-icon"></i></a></div>
                        </div>
                    </div>
                </div>
                <!-- Blog Post -->
            </div>
        </div>
    </section>
    <!-- /Blog Section -->
@endsection
