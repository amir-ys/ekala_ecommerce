@extends('Front::master')
@section('content')

    <section class="inner-page" id="cart-page">
        <div class="container-fluid" id="page-hero">
            <div class="row">
                <div class="col-12">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 px-0">
                                <h1>سبد خرید</h1>
                                <p>مدیریت و خرید همزمان چند محصول</p>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="./index.html">صفحه نخست</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">سبد خرید</li>
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
                                <div id="cart-products">
                                    <div class="container">
                                        <div class="row">
                                            <div class=" mt-2" id="return-to-shop">می‌خواهید محصولات دیگری اضافه
                                                کنید؟ <a href="/">بازگشت به فروشگاه</a></div>
                                            @if(\Modules\Front\Services\CartService::getItems()->count() > 0)
                                                <div class="col-12 py-3">
                                                    <div class="d-none d-md-block">
                                                        <div class="row my-2" id="heading">
                                                            <div class="col-2">
                                                                <div>کالا</div>
                                                            </div>
                                                            <div class="col-2">
                                                                <div>قیمت واحد</div>
                                                            </div>
                                                            <div class="col-1">
                                                                <div>رنگ</div>
                                                            </div>
                                                            <div class="col-1">
                                                                <div>گارانتی</div>
                                                            </div>
                                                            <div class="col-2">
                                                                <div>تعداد</div>
                                                            </div>
                                                            <div class="col-2">
                                                                <div>تخفیف</div>
                                                            </div>
                                                            <div class="col-2 pr-0">
                                                                <div class="pr-3">قیمت نهایی</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Order Product Record -->
                                                    @foreach($cartItems as $cartItem)
                                                        <div class="row product">
                                                            <div class="col-12 col-md-2">
                                                                <div class="row">
                                                                    <div class="col-2 col-md-4 pl-0">
                                                                        <img src="{{ route('image.display'  , $cartItem->associatedModel->primaryImage->name) }}" alt="">
                                                                    </div>
                                                                    <div class="col-10 col-md-8">
                                                                        <a href="{{ $cartItem->associatedModel->path() }}" target="_blank">
                                                                            <div class="title pt-2">
                                                                                {{  $cartItem->associatedModel->name }}
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-6 col-md-2">
                                                                <div class="d-md-none font-weight-bold">قیمت</div>
                                                                <div class="pt-1"><span class="product-price">{{  number_format($cartItem->price) }} </span>
                                                                    <span>تومان</span></div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="pt-1"><span class="product-price">{{  $cartItem->attributes['color'] }} </span></div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="pt-1"><span class="product-price">{{  $cartItem->attributes['warranty'] }} </span></div>

                                                            </div>
                                                            <div class="col-6 col-md-2 pl-4 pr-0 pr-md-3">
                                                                <div class="d-md-none font-weight-bold">{{  $cartItem->quantity }} </div>
                                                                <div class="input-group mb-3 order-number">
                                                                    <div class="input-group-prepend">
                                                                        <button class="btn btn-outline-secondary btn-plus"
                                                                                type="button">+
                                                                        </button>
                                                                    </div>
                                                                        <input form="update-cart" type="text"
                                                                               name="quantity[{{ $cartItem->id }}]" value="{{ $cartItem->quantity }}"
                                                                               class="form-control text-center order-number">
                                                                        <div class="input-group-prepend">
                                                                            <button
                                                                                class="btn btn-outline-secondary btn-minus"
                                                                                type="button">_
                                                                            </button>
                                                                        </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-6 col-md-2">
                                                                @if($cartItem->associatedModel->hasDiscount)
                                                                <div class="d-md-none font-weight-bold">تخفیف</div>
                                                                <div class="pt-1"><span
                                                                        class="product-discount">{{  $cartItem->associatedModel->discountAmount()  }} </span>
                                                                    <span>تومان</span></div>
                                                                @else
                                                                    ندارد
                                                                @endif
                                                            </div>
                                                            <div class="col-6 col-md-2 pr-0">
                                                                <div class="d-md-none font-weight-bold">قیمت نهایی</div>
                                                                <div class="pt-1 pr-2 bg-light"><span class="product-total">{{  number_format($cartItem->quantity * $cartItem->attributes['price_with_discount']) }}</span>
                                                                    <span>تومان</span></div>
                                                                <a href="{{ route('front.cart.remove' , $cartItem->id) }}" class="product-remove btn-remove-from-basket"
                                                                   data-id="">
                                                                    <div class="small pl-2"><i class="fa fa-times"></i> حذف
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <form action="{{ route('front.cart.update') }}" method="get" id="update-cart">
                                                        </form>
                                                        <hr>
                                                    @endforeach
                                                    <!-- Order Product Record -->
                                                    <div class="row product">
                                                        <div class="col-6">
                                                            <a href="#" class="product-remove btn-remove-from-basket"
                                                               data-id="all">
                                                                <a href="{{ route('front.cart.clear') }}" class="btn btn-sm btn-outline-danger float-end small pl-2 font-weight-bold">خالی کردن
                                                                    سبد
                                                                </a>
                                                            </a>
                                                        </div>

                                                        <div class="col-2">
                                                            <a href="#" class=" product-remove btn-remove-from-basket"
                                                               data-id="all">
                                                                <button form="update-cart" href="{{ route('front.cart.clear') }}" class="btn btn-sm btn-outline-success float-end small pl-2 font-weight-bold">
                                                                   بروزرسانی سبد
                                                                </button>
                                                            </a>
                                                        </div>

                                                    </div>
                                                </div>
                                            @else
                                                <div>
                                                    <h5 class="text-center">
                                                        سبد خرید شما خالی است.
                                                    </h5>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-3 mt-2 mt-lg-0 pr-3 pr-lg-0">
                                <div id="factor">
                                    <div class="container">
                                        <div class="row py-2">
                                            <div class="col-6">
                                                <div>مبلغ سفارش:</div>
                                            </div>
                                            <div class="col-6">
                                                <div>
                                                    <span id="factor-total-price">{{ number_format(\Modules\Front\Services\CartService::getTotal()) }}</span> تومان
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row py-2 bg-light">
                                            <div class="col-6">
                                                <div>مبلغ تخفیف (اعمال شده) :</div>
                                            </div>
                                            <div class="col-6">
                                                <div><span id="factor-total-discount"></span>    {{ number_format($getDiscountAmount = getDiscountAmount())  }} تومان</div>
                                            </div>
                                        </div>
                                        @if(session()->has('coupon'))
                                            <div class="row py-2 bg-light">
                                                <div class="col-6">
                                                    <div>کد تخفیف : </div>
                                                </div>
                                                <div class="col-6">
                                                    <div><span id="factor-total-discount"></span>    {{ number_format(session()->get('coupon')['amount'])  }} تومان</div>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="row py-2" id="total">
                                            <div class="col-6">
                                                <div>مبلغ قابل پرداخت:</div>
                                            </div>
                                            <div class="col-6">
                                                <div><span id="factor-total">
                                                        @php
                                                        $discountAmount = 0;
                                                            if (session()->has('coupon')) $discountAmount += session('coupon')['amount'];
                                                        @endphp
                                                        {{ number_format(\Modules\Front\Services\CartService::getTotal() - $getDiscountAmount ) }}</span> تومان
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row py-2">
                                            <div class="col-12">
                                                <a href="{{ route('front.checkout.page')  }}"><input type="submit" value="ادامه ثبت سفارش"
                                                                                 class="btn btn-success w-100"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-9 width-100">
                                <div class="cart-products">
                                    <div class="container">
                                        <div class="row">
                                            <div class="cart border border-2">
                                                <div class="cart-body mb-1 mt-1">
                                                    <form method="get" action="{{ route('front.coupon.check') }}">
                                                        <div class="row">
                                                            <div class="col-lg-4">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="code"
                                                                           name="code" placeholder=" کد تخفیف" required value="{{old("code")}}">
                                                                    <x-validation-error field="code" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2 mb-1">
                                                                <div class="form-group">
                                                                    <button class="btn btn-outline-success font-weight-bold" type="submit" > ثبت </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Suggested Products -->
                            <div class="col-12 pt-5" id="suggested-products">
                                <div class="title py-3 text-center">سایر محصولات پیشنهادی</div>
                                <div class="owl-carousel products-carousel">
                                    @foreach($suggestionProducts as $product)
                                        @include('Front::partials.product-box' , ['product' => $product])
                                    @endforeach
                                </div>
                            </div>
                            <!-- /Suggested Products -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
