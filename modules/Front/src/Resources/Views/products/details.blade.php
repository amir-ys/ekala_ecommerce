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
                                            @if($product->findProductInWishlist(auth()->id()))
                                                <a class="btn btn-outline-secondary bg-danger btn-favorite mt-1 mt-sm-0"
                                                   href="/" onclick="removeProductFromWishlist('{{ $product->id }}')"
                                                   data-toggle="tooltip" data-placement="top"
                                                   title="حذف از علاقه‌مندی"></a>
                                            @else
                                                <a class="btn btn-outline-secondary btn-favorite mt-1 mt-sm-0"
                                                   href="/" onclick="addProductToWishlist('{{ $product->id }}')"
                                                   data-toggle="tooltip" data-placement="top"
                                                   title="افزودن به علاقه‌مندی"></a>
                                            @endif

                                            <a href="#">
                                                <div class="btn btn-outline-secondary btn-compare mt-1 mt-sm-0"
                                                     data-toggle="tooltip" data-placement="top" title="مقایسه"></div>
                                            </a>
                                        </div>
                                        <form action="{{ route('products.wishlist.add' , $product->id) }}"
                                              method="post" id="add-product-to-wishlist-{{$product->id}}">
                                            @csrf
                                            @method('post')
                                        </form>

                                        <form action="{{ route('products.wishlist.remove' , $product->id) }}"
                                              method="post" id="remove-product-from-wishlist-{{$product->id}}">
                                            @csrf
                                            @method('post')
                                        </form>

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
                                                <button
                                                    class="tab-item tablink px-3 @if($errors->count() == 0 ) selected @endif"
                                                    onclick="openTab(event,'html-tab')">نقد و بررسی
                                                </button>
                                                <button class="tab-item tablink px-3"
                                                        onclick="openTab(event,'details-tab')">جدول مشخصات
                                                </button>
                                                <button
                                                    class="tab-item tablink px-3 @if($errors->count() > 0 ) selected @endif"
                                                    onclick="openTab(event,'comments-tab')">دیدگاه کاربران
                                                    ({{ $product->comments()->count() }})
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
                                                @include('Front::partials.product-attributes'  , ['product' => $product])
                                                <!-- /Details Tab -->

                                                <!-- Comments Tab -->
                                                @include('Front::partials.product-comments'  , ['product' => $product])
                                                <!-- /Comments Tab -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Nav Tabs -->

                        <!-- Suggested Products -->
                        @include('Front::partials.suggested-products')
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
    <script>
        if ("{{ $errors->count() > 0 }}") {
            document.getElementById('comments-tab').style.display = "block";
        }

        function defaultComment() {
            event.preventDefault()
            $('#reply-comment-text').remove();
            $('#comment-parent-id').val(null)
            $('#back-to-default').remove(null)
        }

        function replyComment(event  , username , parent_id) {
            event.preventDefault()
            var navigationFn = {
                goToSection: function(id) {
                    $('html, body').animate({
                        scrollTop: $(id).offset().top
                    }, 0);
                }
            }
            navigationFn.goToSection('#store-comment-element');
            $('#store-comment-textarea').focus();
            var data = '<span id="reply-comment-text">'  + 'در پاسخ به نظر کاربر ' + username  +
                ' <a id="back-to-default" href="/" onclick="defaultComment()" >بازگشت</a> ' + '</span>';
            $('#comment-text').html(data);
            $('#comment-parent-id').val(parent_id)
        }

        function addProductToWishlist(id) {
            event.preventDefault();
            document.getElementById('add-product-to-wishlist-' + id).submit()
        }

        function removeProductFromWishlist(id) {
            event.preventDefault();
            document.getElementById('remove-product-from-wishlist-' + id).submit()
        }


    </script>

@endsection
