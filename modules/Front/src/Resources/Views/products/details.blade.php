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
                            <div class="col-12 col-lg-4 px-lg-0">
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
                            <div class="col-12 col-lg-8 mt-5 mt-lg-0 pl-lg-0" id="product-intro">
                                <div class="row">
                                    <div class="col-md-7 mr-md-5">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="cta-container">
                                                    <div class="row">
                                                        <div class="d-flex justify-content-between">
                                                            <div>
                                                                <a href="./product.html">
                                                                    <h5>{{$product->name}}</h5>
                                                                </a>
                                                            </div>
                                                            <div>
                                                                <br class="d-sm-none">
                                                                @if($product->findProductInWishlist(auth()->id()))
                                                                    <a class="wishlist-item btn btn-outline-secondary bg-danger btn-favorite mt-sm-0"
                                                                       href="/"
                                                                       onclick="addOrRemoveProductFromWishlist('{{ route('products.wishlist.add' , $product->id) }}')"
                                                                       data-toggle="tooltip" data-placement="top"
                                                                       title="حذف از علاقه‌مندی"></a>
                                                                @else
                                                                    <a class="wishlist-item btn btn-outline-secondary btn-favorite mt-sm-0"
                                                                       href="/"
                                                                       onclick="addOrRemoveProductFromWishlist('{{ route('products.wishlist.add' , $product->id) }}')"
                                                                       data-toggle="tooltip" data-placement="top"
                                                                       title="افزودن به علاقه‌مندی"></a>
                                                                @endif


                                                                <form action="{{ route('products.wishlist.checkUserIsLogin') }}" id='check-user-is-login'>
                                                                    @csrf
                                                                </form>

{{--                                                                <a href="{{ route('front.compare.add' , $product->id) }}">--}}
{{--                                                                    <div--}}
{{--                                                                        class="btn btn-outline-secondary btn-compare mt-1 mt-sm-0"--}}
{{--                                                                        data-toggle="tooltip" data-placement="top"--}}
{{--                                                                        title="مقایسه"></div>--}}
{{--                                                                </a>--}}

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                {{--                                                <div class="stars-container">--}}
                                                {{--                                                    <i class="fa fa-star"></i>--}}
                                                {{--                                                    <i class="fa fa-star"></i>--}}
                                                {{--                                                    <i class="fa fa-star"></i>--}}
                                                {{--                                                    <i class="fa fa-star"></i>--}}
                                                {{--                                                    <i class="fa fa-star"></i>--}}
                                                {{--                                                    <a href="#tabs-panel"><span>(نقد و بررسی)</span></a>--}}
                                                {{--                                                </div>--}}
                                                <hr>

                                              <div class="card border">
                                                  <div class="card-body">
                                                      <div  class="row">
                                                          <div class="col-md-6">رنگ انتخابی: <span id="selected_color"> </span></div>
                                                          <div class="col-md-6">گارانتی انتخابی: <span id="selected_warranty"></span></div>
                                                      </div>
                                                  </div>
                                              </div>
                                                <div class="variables">
                                                    <div class="title">گزینه های موجود:</div>
                                                    <div class="row">
                                                        @if($product->colors()->count() > 0 )
                                                            <div class="col-12 col-sm-4 col-lg-6 mb-md-2 ">
                                                                <div class="variable">
                                                                    <div class="sub-title pt-2 pb-2">رنگ</div>
                                                                    @foreach($product->colors()->get()  as $key =>  $color)
                                                                        <label class="color-variable" for="color_input_{{ $color->id }}"
                                                                            style="background-color:{{ $color->color_value }};
                                                                            height: 30px ; width: 30px" ></label>
                                                                        <input class="d-none" type="radio" name="color_id"  id="color_input_{{ $color->id }}"
                                                                               value="{{ $color->id }}" data-color-price="{{ $color->price_increase }}"
                                                                               data-color-name="{{ $color->color_name }}"
                                                                        @if($key == 0) checked @endif
                                                                        >
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        @endif
                                                        <div class="col-12 col-sm-4 col-lg-6">
                                                            <div class="variable">
                                                                <div class="sub-title pt-2 pb-2">گارانتی</div>
                                                                <select name="warranty_id" class="form-select">
                                                                    @if($product->warranties()->get()->count() > 0)
                                                                    @foreach($product->warranties()->get()  as $warranty)
                                                                        <option
                                                                            id="warranty_item"
                                                                            value="{{ $warranty->id }}"
                                                                            data-warranty-name="{{ $warranty->name }}"
                                                                            data-warranty-price="{{ $warranty->price_increase }}"
                                                                        >{{ $warranty->name }}</option>
                                                                    @endforeach
                                                                    @else
                                                                        <option value>بدون گارانتی</option>
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <form action="{{ route('front.cart.add') }}" method="get"
                                                          id="add_to_card">
                                                        <input type="hidden" name="product_id"
                                                               value="{{ $product->id }}">
                                                        <div class="row">
                                                            <div class="col-12 col-sm-6 col-lg-6">
                                                                <div class="variable">
                                                                    <div class="sub-title pt-3 mb-md-2">تعداد</div>
                                                                    <div class="input-group mb-3 order-number">
                                                                        <div class="input-group-prepend">
                                                                            <button class="btn btn-outline-secondary btn-inc btn-change-quantity"
                                                                                type="button">+
                                                                            </button>
                                                                        </div>
                                                                        <input type="text" value="1"
                                                                               class="form-control text-center order-number"
                                                                               readonly id="quantity"
                                                                               name="quantity" min="1"
                                                                               max="{{ $product->quantity }}">
                                                                        <div class="input-group-prepend">
                                                                            <button class="btn btn-outline-secondary btn-dec btn-change-quantity"
                                                                                type="button">_
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <p>{!! $product->description !!} </p>

                                                        </div>
                                                    </form>
                                                </div>
                                                <!-- Share Links -->
                                                <div id="share-links">
                                                    <span>اشتراک گذاری: </span>
                                                    <a href="#" target="_blank"><span class="share-link"><img
                                                                src="/assets/front/assets/images/social/twitter.png"
                                                                alt="توئیتر"
                                                                width="18px"></span></a>
                                                    <a href="#" target="_blank"><span class="share-link"><img
                                                                src="/assets/front/assets/images/social/insta.png"
                                                                alt="اینستاگرام"
                                                                width="18px"></span></a>
                                                    <a href="#" target="_blank"><span class="share-link"><img
                                                                src="/assets/front/assets/images/social/linkedin.png"
                                                                alt="لینکدین"
                                                                width="18px"></span></a>
                                                    <a href="#" target="_blank"><span class="share-link"><img
                                                                src="/assets/front/assets/images/social/facebook.png"
                                                                alt="فیس بوک"
                                                                width="18px"></span></a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Share Links -->
                                    </div>
                                    <div class="col-md-5">
                                        <div class="card border border-2">
                                            <div class="card-body">
                                                <div class="bg-light d-flex justify-content-between">
                                                    <div>قیمت کالا:</div>
                                                    <div>
                                                        <span id="product_original_price"
                                                              data-product-original-price="{{ $product->price }}"
                                                            class="price text-left">{{ $product->formattedPrice() }}
                                                        </span>
                                                        <span>تومان</span>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="bg-light d-flex justify-content-between">
                                                    <div> تخفیف کالا:</div>
                                                    <div>
                                                        @if($product->hasDiscount)
                                                            <span class="pre-price" id="product_discount_price" data-product-discount-price="{{ $product->discountAmount() }}"
                                                            >{{ number_format($product->discountAmount()) }}
                                                            </span>
                                                        @else
                                                            0
                                                        @endif
                                                                <span>تومان</span>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="bg-light d-flex justify-content-between">
                                                    <div><span>جمع نهایی:</span></div>
                                                    <div>
                                                            <span class="pre-price" id="product_final_price">{{ number_format($product->finalPrice()) }}
                                                            </span>
                                                        <span>تومان</span>
                                                    </div>
                                                </div>

                                                @if($product->quantity > 0)
                                                <div class="col-md-12 w-100 mt-md-3">
                                                    <button type="submit" form="add_to_card"
                                                            class="btn btn-success btn-add-to-basket btn-sm btn-block w-100">
                                                        <i class="fa fa-shopping-cart"></i> افزودن به سبد خرید
                                                </div>
                                                @else

                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                                                <div id="html-tab" class="tabs-container text-justify p-0 p-md-3"
                                                @if($errors->count() > 0) style="display: none" @endif>
                                                    {!! $product->description !!}
                                                </div>
                                                <!-- /HTML Tab -->

                                                <!-- Details Tab -->
                                                @include('Front::partials.product-attributes'  , ['product' => $product])
                                                <!-- /Details Tab -->

                                                <!-- Comments Tab -->
                                                @include('Front::partials.model-comments'  , ['model' => $product ,  'type' => 'محصول'])
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

        $(document).ready(function () {
            bill();

            $('input[name="color_id"]').change(function (){
                bill();
            })

            $('select[name="warranty_id"]').change(function (){
                bill();
            })

            $('.btn-inc').click(function () {
                bill();
            })

            $('.btn-dec').click(function () {
                bill();
            })
        })

        function bill() {
            //color
            let color_name = $("input[name='color_id']:checked").attr('data-color-name');
            $('#selected_color').html(color_name);

            //warranty
            let warranty_name = $("select[name='warranty_id'] option:selected").text();
            if(warranty_name){
                $('#selected_warranty').html(warranty_name);
            }else{
                $('#selected_warranty').html('بدون گارانتی');

            }

            let product_original_price =  parseFloat($("#product_original_price").attr('data-product-original-price'));
            let product_discount_price = 0;
            let selected_color_price = 0;
            let selected_warranty_price = 0;
            let quantity = 0;


            if($("input[name='color_id']:checked").length > 0){
                selected_color_price = parseFloat($("input[name='color_id']:checked").attr('data-color-price'))
            }

            if($("select[name='warranty_id'] option:selected option[id='warranty_item']").length > 0){
                selected_warranty_price = parseFloat($("select[name='warranty_id'] option:selected").attr('data-warranty-price'))
            }

            if($("input[name='quantity']").val() > 0){
                quantity = parseFloat($("input[name='quantity']").val())
            }

            if($("#product_discount_price").length > 0){
                product_discount_price = parseFloat($("#product_discount_price").attr('data-product-discount-price'))
            }

            // console.log(
            //     product_original_price ,
            // product_discount_price ,
            // selected_color_price ,
            // selected_warranty_price ,
            // quantity ,)

            let product_price = product_original_price + selected_warranty_price + selected_color_price;
            let final_price = quantity * ( product_price - product_discount_price )

            $('#product_original_price').html(formatter.format(product_price))
            $('#product_final_price').html(formatter.format(final_price))

        }


        var formatter = new Intl.NumberFormat('fa-IR');



        $('.btn-inc').click(function () {
            var current_q = $('#quantity').attr('value');
            $('#quantity').attr('value', parseInt(current_q) + 1)
        })

        $('.btn-dec').click(function () {
            var current_q = $('#quantity').attr('value');
            if (current_q == 0) {
                $('#quantity').attr('value', 0)
            } else {
                $('#quantity').attr('value', parseInt(current_q) - 1)
            }
        })

        if ("{{ $errors->count() > 0 }}") {
            document.getElementById('comments-tab').style.display = "block";
        }

        function defaultComment() {
            event.preventDefault()
            $('#reply-comment-text').remove();
            $('#comment-parent-id').val(null)
            $('#back-to-default').remove(null)
        }

        function replyComment(event, username, parent_id) {
            event.preventDefault()
            var navigationFn = {
                goToSection: function (id) {
                    $('html, body').animate({
                        scrollTop: $(id).offset().top
                    }, 0);
                }
            }
            navigationFn.goToSection('#store-comment-element');
            $('#store-comment-textarea').focus();
            var data = '<span id="reply-comment-text">' + 'در پاسخ به نظر کاربر ' + username +
                ' <a id="back-to-default" href="/" onclick="defaultComment()" >بازگشت</a> ' + '</span>';
            $('#comment-text').html(data);
            $('#comment-parent-id').val(parent_id)
        }

        function addOrRemoveProductFromWishlist(route) {
            event.preventDefault();
            if("{{ auth()->check() }}"){
            $.ajax({
                url : route ,
                type : 'POST' ,
                data : { _token : "{{ csrf_token() }}" } ,
                 success : function (response) {
                    if (response.data == true){
                        $('.wishlist-item').addClass('bg-danger')
                    }else if(response.data == false){
                        $('.wishlist-item').removeClass('bg-danger')
                    }
                }
            })
            }else{
                document.getElementById('check-user-is-login').submit()
            }
        }


    </script>

@endsection
