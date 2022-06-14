@extends('Front::master')
@section('content')
    <section class="inner-page" id="product-page">
        <div class="container-fluid" id="page-hero">
            <div class="row">
                <div class="col-12">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 px-0">
                                <h1>{{ $product->name }} </h1>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="./index.html">صفحه نخست</a></li>
                                        <li class="breadcrumb-item"><a href="./products.html">فروشگاه</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">گوشی موبایل</li>
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
                            <div class="col-12 col-lg-5 px-lg-0">
                                <div class="swiper-container gallery-top">
                                    <!-- Additional required wrapper -->
                                    <ul class="swiper-wrapper">
                                        <!-- Slides -->
                                        @foreach($product->allImages as $image)
                                            <li id="1" class="swiper-slide">
                                                <a href="{{ $image->name
                                                ? route('image.display' , $image->name) : ''}}" itemprop="contentUrl"
                                                   data-size="900x710">
                                                    <img style="height:100%;width: 100%" src="{{ $image->name
                                                ? route('image.display' , $image->name) : ''}}"
                                                         itemprop="thumbnail"
                                                         alt="{{ $product->name }}"/>
                                                </a>
                                            </li>
                                        @endforeach
                                        <!-- /Slides -->
                                    </ul>
                                    <!-- If we need navigation buttons -->
                                    <div title="قبلی" class="swiper-button-prev swiper-button-white"></div>
                                    <div title="بعدی" class="swiper-button-next swiper-button-white"></div>
                                </div>

                                <!-- Swiper -->
                                <div class="swiper-container gallery-thumbs">
                                    <div class="swiper-wrapper">
                                            @foreach($product->allImages as $image)
                                                <div class="swiper-slide">
                                                    <img style="height:100%;width: 100%" src="{{ $image->name
                                                ? route('image.display' , $image->name) : ''}}" alt="">
                                                </div>
                                            @endforeach
                                    </div>
                                </div>

                                <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="pswp__bg"></div>
                                    <div class="pswp__scroll-wrap">
                                        <div class="pswp__container">
                                            <div class="pswp__item"></div>
                                            <div class="pswp__item"></div>
                                            <div class="pswp__item"></div>
                                        </div>
                                        <div class="pswp__ui pswp__ui--hidden">
                                            <div class="pswp__top-bar">
                                                <div class="pswp__counter"></div>
                                                <button class="pswp__button pswp__button--close"
                                                        title="بستن (Esc)"></button>
                                                <button class="pswp__button pswp__button--fs"
                                                        title="تمام صفحه"></button>
                                                <button class="pswp__button pswp__button--zoom"
                                                        title="بزرگنمایی"></button>
                                                <div class="pswp__preloader">
                                                    <div class="pswp__preloader__icn">
                                                        <div class="pswp__preloader__cut">
                                                            <div class="pswp__preloader__donut"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="pswp__button pswp__button--arrow--left"
                                                    title="قبلی"></button>
                                            <button class="pswp__button pswp__button--arrow--right"
                                                    title="بعدی"></button>
                                            <div class="pswp__caption">
                                                <div class="pswp__caption__center"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-7 mt-5 mt-lg-0 pl-lg-0" id="product-intro">
                                <a href="./product.html">
                                    <h1>{{$product->name}}</h1>
                                </a>
                                <div class="stars-container">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <a href="#tabs-panel"><span>(نقد و بررسی)</span></a>
                                </div>
                                <div class="price-container py-2">
                                    <span class="pre-price">{{ $product->formattedPrice() }}</span>
                                    <span class="price">{{ $product->priceWithDiscount() }} <span>تومان</span></span>
                                    <div class="badge badge-danger font-weight-light m-1 py-1 px-2">10%</div>
                                </div>
                                <p>{{ $product->description }}</p>
                                <hr>
                                <div class="variables">
                                    <div class="title">گزینه های موجود:</div>
                                    <div class="row">
                                        <div class="col-12 col-sm-4 col-lg-3">
                                            <div class="variable">
                                                <div class="sub-title pt-2 pb-3">رنگ</div>
                                                <span class="color-variable"><a href="#" class="red"></a></span>
                                                <span class="color-variable"><a href="#" class="yellow"></a></span>
                                                <span class="color-variable"><a href="#" class="blue"></a></span>
                                                <span class="color-variable"><a href="#" class="black"></a></span>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4 col-lg-3">
                                            <div class="variable">
                                                <div class="sub-title pt-2 pb-2">گارانتی</div>
                                                <select name="" class="form-select">
                                                    <option value="">بدون گارانتی</option>
                                                    <option value="">گارانتی 6 ماهه</option>
                                                    <option value="">گارانت 12 ماهه</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4 col-lg-3">
                                            <div class="variable">
                                                <div class="sub-title pt-2 pb-2">تعداد</div>
                                                <input type="number" min="1" max="10" class="form-control" value="1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cta-container pt-3 pt-md-5">
                                    <div class="row">
                                        <div class="col-12">
                                            <a href="./cart.html">
                                                <div class="btn btn-success px-4 px-lg-2 px-xl-4 btn-add-to-basket"><i
                                                        class="fa fa-shopping-cart"></i> افزودن به سبد خرید
                                                </div>
                                            </a>
                                            <br class="d-sm-none">
                                            <div class="btn btn-outline-secondary btn-favorite mt-1 mt-sm-0"
                                                 data-toggle="tooltip" data-placement="top"
                                                 title="افزودن به علاقه‌مندی"></div>
                                            <a href="#">
                                                <div class="btn btn-outline-secondary btn-compare mt-1 mt-sm-0"
                                                     data-toggle="tooltip" data-placement="top" title="مقایسه"></div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Share Links -->
                                <div class="pt-5" id="share-links">
                                    <span>اشتراک گذاری: </span>
                                    <a href="#" target="_blank"><span class="share-link"><img
                                                src="/assets/front/assets/images/social/twitter.png" alt="توئیتر"
                                                width="18px"></span></a>
                                    <a href="#" target="_blank"><span class="share-link"><img
                                                src="/assets/front/assets/images/social/insta.png" alt="اینستاگرام"
                                                width="18px"></span></a>
                                    <a href="#" target="_blank"><span class="share-link"><img
                                                src="/assets/front/assets/images/social/linkedin.png" alt="لینکدین"
                                                width="18px"></span></a>
                                    <a href="#" target="_blank"><span class="share-link"><img
                                                src="/assets/front/assets/images/social/facebook.png" alt="فیس بوک"
                                                width="18px"></span></a>
                                </div>
                                <!-- Share Links -->
                            </div>

                            <!-- Nav Tabs -->
                            <div class="col-12">
                                <div id="product-nav-tabs">
                                    <div class="row pt-3 px-md-3">
                                        <div class="col-12">
                                            <div id="tabs-panel">
                                                <button class="tab-item tablink px-3 selected"
                                                        onclick="openTab(event,'html-tab')">نقد و بررسی
                                                </button>
                                                <button class="tab-item tablink px-3"
                                                        onclick="openTab(event,'details-tab')">جدول مشخصات
                                                </button>
                                                <button class="tab-item tablink px-3"
                                                        onclick="openTab(event,'comments-tab')">دیدگاه کاربران ({{ $product->comments()->count() }})
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-12 pt-2 px-0 px-lg-0">
                                                <!-- HTML Tab -->
                                                <div id="html-tab" class="tabs-container text-justify p-0 p-md-3">
                                                    {!! $product->description !!}
                                                </div>
                                                <!-- /HTML Tab -->

                                                <!-- Details Tab -->
                                                <div id="details-tab" class="tabs-container px-0 px-md-3 pb-0 pb-md-3" style="display:none">
                                               @foreach($product->category->attributeGroups as $attributeGroup)
                                                    <!-- Detail Section -->
                                                    <div class="row">
                                                        <div class="col-12 my-2">
                                                            <span class="detail-title"><i
                                                                    class="fa fa-chevron-left small"></i> {{ $attributeGroup->name }} </span>
                                                        </div>
                                                    </div>
                                                    @foreach($attributeGroup->attributes as $attribute)
                                                    <div class="row mb-2">
                                                        <div class="col-12 col-md-3 font-weight-bold">
                                                            <div class="bg-light p-2">{{ $attribute->name }}</div>
                                                        </div>
                                                        <div class="col-12 col-md-9 pr-md-0">
                                                            <div class="bg-light p-2">  {{ $attribute->getValueForProduct($product) }}</div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    <!-- /Detail Section -->
                                                @endforeach
                                                </div>
                                                <!-- /Details Tab -->

                                                <!-- Comments Tab -->
                                                <div id="comments-tab" class="tabs-container px-0 px-md-3 pb-0 pb-md-2"
                                                     style="display:none">
                                                    <div class="row">
                                                        <div class="col-12 text-justify" id="comments">
                                                            <div class="comments-container">
                                                                <div class="container px-0">
                                                                    <div class="row">
                                                                        <div class="col-12 pt-2">
                                                                            <!-- Show Comments -->
                                                                            <div class="comment p-3 my-2">
                                                                                <div class="sender-details">
                                                                                    <div class="row">
                                                                                        <div
                                                                                            class="col-3 col-sm-2 col-md-1 pl-md-0 pl-lg-2 pl-xl-3">
                                                                                            <img
                                                                                                src="/assets/front/assets/images/user-no-image.jpg"
                                                                                                alt="" class="rounded">
                                                                                        </div>
                                                                                        <div
                                                                                            class="col-9 col-sm-10 col-md-11 pr-0 pr-md-2 pr-xl-0 pt-0 pt-lg-1">
                                                                                            <div class="name">مصطفی
                                                                                                کلانتری
                                                                                            </div>
                                                                                            <div class="date">ارسال شده
                                                                                                در 18 تیر 1400
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12">
                                                                                            <p>این یک متن آزمایشی است که
                                                                                                به زودی توسط نویسنده این
                                                                                                سایت، تکمیل یا حذف خواهد
                                                                                                شد. اگر شما نویسنده‌ی
                                                                                                این سایت هستید، برای حذف
                                                                                                یا ویرایش این صفحه، کافی
                                                                                                است از طریق مرکز مدیریت
                                                                                                سایت خود وارد بخش مربوطه
                                                                                                شده و محتوای این صفحه را
                                                                                                ویرایش یا حذف کنید.</p>
                                                                                            <span class="reply"><img
                                                                                                    src="/assets/front/assets/images/comment-reply.png"
                                                                                                    alt=""> ارسال پاسخ</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <!-- Comment Reply -->
                                                                                <div class="row justify-content-end">
                                                                                    <div class="col-11 pt-2 pr-0">
                                                                                        <div class="comment p-3">
                                                                                            <div class="sender-details">
                                                                                                <div class="row">
                                                                                                    <div
                                                                                                        class="col-3 col-sm-2 col-md-1 pl-md-0 pl-lg-2 pl-xl-3">
                                                                                                        <img
                                                                                                            src="/assets/front/assets/images/user-no-image.jpg"
                                                                                                            alt=""
                                                                                                            class="rounded">
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="col-9 col-sm-10 col-md-11 pr-0 pr-md-2 pr-xl-0 pt-0 pt-lg-1">
                                                                                                        <div
                                                                                                            class="name">
                                                                                                            امین کیانی
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="date">
                                                                                                            ارسال شده در
                                                                                                            18 تیر 1400
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-12">
                                                                                                        <p>صفحات و
                                                                                                            محتوای
                                                                                                            آزمایشی
                                                                                                            همیشه بخشی
                                                                                                            از محتوای
                                                                                                            پیش‌نمایش
                                                                                                            قالب و
                                                                                                            افزونه های
                                                                                                            وب هستند که
                                                                                                            شما بتوانید
                                                                                                            ارتباط درستی
                                                                                                            با پیش نمایش
                                                                                                            قالب گرفته و
                                                                                                            تصمیم مناسبی
                                                                                                            بگیرید. این
                                                                                                            صفحات معمولا
                                                                                                            برای اطلاعات
                                                                                                            کلی در مورد
                                                                                                            سایت مثل
                                                                                                            «درباره ما»،
                                                                                                            «تماس با
                                                                                                            ما»، «فهرست»
                                                                                                            یا «نظرات
                                                                                                            شما» مفید
                                                                                                            هستند.</p>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <!-- /Comment Reply -->
                                                                            </div>
                                                                            <!-- /Show Comments -->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Send Comment Form -->
                                                            <div class="comments-container">
                                                                <div class="row pt-4">
                                                                    <div class="col-12"><h2>دیدگاه خود را ارسال
                                                                            کنید</h2></div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-12 py-3">
                                                                        <form method="post" action="/">
                                                                            <div id="send-comment-form">
                                                                                <p>نظر خود را برای این مطلب ارسال کنید.
                                                                                    نشانی ایمیل شما منتشر نخواهد شد.</p>
                                                                                <div class="row">
                                                                                    <div
                                                                                        class="col-12 px-3 pl-md-1 col-md-6">
                                                                                        <div class="form-group my-1">
                                                                                            <input type="text"
                                                                                                   class="form-control"
                                                                                                   placeholder="* نام شما"
                                                                                                   required
                                                                                                   oninvalid="this.setCustomValidity('لطفا نام خود را وارد کنید')"
                                                                                                   oninput="setCustomValidity('')">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div
                                                                                        class="col-12 px-3 pr-md-1 col-md-6">
                                                                                        <div class="form-group my-1">
                                                                                            <input type="email"
                                                                                                   class="form-control text-start"
                                                                                                   placeholder="پست الکترونیک *"
                                                                                                   required
                                                                                                   oninvalid="this.setCustomValidity('لطفا پست الکترونیک خود را وارد کنید')"
                                                                                                   oninput="setCustomValidity('')">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-12">
                                                                                        <div class="form-group my-1">
                                                                                            <textarea
                                                                                                class="form-control"
                                                                                                id="" rows="4"
                                                                                                placeholder="متن دیدگاه"></textarea>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-12">
                                                                                        <div class="form-group my-1">
                                                                                            <input type="submit"
                                                                                                   value="ارسال دیدگاه"
                                                                                                   class="btn btn-success px-5">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- /Send Comment Form -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /Comments Tab -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Nav Tabs -->

                        <!-- Suggested Products -->
                        <div class="col-12 pt-5" id="suggested-products">
                            <div class="title py-3 text-center">محصولات مرتبط</div>
                            <div class="owl-carousel products-carousel">
                                <!-- Product Item -->
                                <div class="product-box item">
                                    <a href="./product.html">
                                        <div class="image"
                                             style="background-image: url('/assets/front/assets/images/products/p303.png')"></div>
                                    </a>
                                    <div class="details p-3">
                                        <div class="category">
                                            <a href="./products.html">گوشی موبایل</a>
                                            &nbsp;/&nbsp;
                                            <a href="./products.html">سامسونگ</a>
                                        </div>
                                        <a href="./product.html"><h2>مودم روتر ADSL2 Plus بی‌ سیم N300 دی-لینک مدل
                                                DSL-2740U</h2></a>
                                        <div class="price">3.000.000 تومان</div>
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
                                <!-- /Product Item -->
                                <!-- Product Item -->
                                <div class="product-box item">
                                    <a href="./product.html">
                                        <div class="image"
                                             style="background-image: url('/assets/front/assets/images/products/p201.png')"></div>
                                    </a>
                                    <div class="details p-3">
                                        <div class="category">
                                            <a href="./products.html">گوشی موبایل</a>
                                            &nbsp;/&nbsp;
                                            <a href="./products.html">سامسونگ</a>
                                        </div>
                                        <a href="./product.html"><h2>لپ تاپ 14 اینچی ایسوس مدل ZenBook UM433IQ -
                                                A5023</h2></a>
                                        <div class="price">5.000.000 تومان</div>
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
                                <!-- /Product Item -->
                                <!-- Product Item -->
                                <div class="product-box item">
                                    <a href="./product.html">
                                        <div class="image"
                                             style="background-image: url('/assets/front/assets/images/products/p302.png')"></div>
                                    </a>
                                    <div class="details p-3">
                                        <div class="category">
                                            <a href="./products.html">گوشی موبایل</a>
                                            &nbsp;/&nbsp;
                                            <a href="./products.html">سامسونگ</a>
                                        </div>
                                        <a href="./product.html"><h2>اسپیکر بلوتوثی قابل حمل تی اند جی مدل Tg-113</h2>
                                        </a>
                                        <div class="price">4.000.000 تومان</div>
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
                                <!-- /Product Item -->
                                <!-- Product Item -->
                                <div class="product-box item">
                                    <a href="./product.html">
                                        <div class="image"
                                             style="background-image: url('/assets/front/assets/images/products/p203.png')"></div>
                                    </a>
                                    <div class="details p-3">
                                        <div class="category">
                                            <a href="./products.html">گوشی موبایل</a>
                                            &nbsp;/&nbsp;
                                            <a href="./products.html">سامسونگ</a>
                                        </div>
                                        <a href="./product.html"><h2>لپ تاپ 15 اینچی ایسوس مدل VivoBook X543MA - A</h2>
                                        </a>
                                        <div class="price">3.000.000 تومان</div>
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
                                <!-- /Product Item -->
                            </div>
                        </div>
                        <!-- /Suggested Products -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('css')
    <link rel="stylesheet" href="/assets/front/assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/assets/front/assets/css/swiper-bundle.min.css">
    <link rel="stylesheet" href="/assets/front/assets/css/product-gallery.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/photoswipe/4.1.3/photoswipe.min.css"/>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/photoswipe/4.1.3/default-skin/default-skin.min.css"/>
@endsection

@section('script')
    <script src="/assets/front/assets/js/owl.carousel.min.js"></script>
    <script src="/assets/front/assets/js/nav-tabs.js"></script>
    <script src="/assets/front/assets/js/swiper-bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/photoswipe/4.1.3/photoswipe.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/photoswipe/4.1.3/photoswipe-ui-default.min.js"></script>
    <script src="/assets/front/assets/js/product-gallery.js"></script>

    <script src="/assets/front/assets/js/scripts.js"></script>
@endsection
