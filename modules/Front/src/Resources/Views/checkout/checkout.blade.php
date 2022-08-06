@extends('Front::master')
@section('content')

    <section class="inner-page" id="checkout-page">
        <div class="container-fluid" id="page-hero">
            <div class="row">
                <div class="col-12">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 px-0">
                                <h1>پیش فاکتور</h1>
                                <p>با تکیمل پرداخت فاکتور، خرید خود را تکمیل کنید.</p>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="./index.html">صفحه نخست</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">پیش فاکتور</li>
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
                                <!-- Choose Address -->
                                <section id="choose-address">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-12 py-3">
                                                <div class="pb-1 title">آدرس تحویل سفارش</div>
                                                <div class="row">
                                                    <div class="col-12 col-md-9 pl-0" id="address-detail">
                                                        <div class="p-3 ml-3 mb-2 mb-md-0 ml-md-0 address-to-send">
                                                            <div class="address-title">
                                                                <span id="province-title">فارس</span>،
                                                                <span id="city-title">شیراز</span>،
                                                                <span
                                                                    id="address">بلوار آزادگان، کارخانه نوآوری شیراز</span>،
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-12 col-md-4">کدپستی: 1234567890</div>
                                                                <div class="col-12 col-md-8">تحویل گیرنده: مصطفی |
                                                                    09351234567
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <div class="row">
                                                            <div class="col-6 col-md-12 pl-2 px-md-3">
                                                                <a href="#">
                                                                    <div class="btn btn-light w-100">تغییر آدرس</div>
                                                                </a>
                                                            </div>
                                                            <div class="col-6 col-md-12 pr-2 px-md-3">
                                                                <a href="#">
                                                                    <div
                                                                        class="btn btn-outline-dark mt-0 mt-md-1 w-100">
                                                                        افزودن آدرس جدید
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <!-- /Choose Address -->

                                <!-- Orders List -->
                                <section class="mt-3" id="orders">
                                    <div class="container mt-2">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="pb-1 title">سفارشات شما</div>
                                                <div class="row">
                                                    <!-- Order Product Record -->
                                                    @foreach(\Modules\Front\Services\CartService::getItems() as $cartItem)
                                                        <span class="col-6 col-sm-4 col-lg-3 px-0">
                                                    <a href="{{ $cartItem->associatedModel->path() }}" target="_blank">
                                                        <div class="product-box">
                                                            <div class="image">
                                                                <img src="{{ $cartItem->associatedModel->primaryImage
                                                                    ? route('image.display' , $cartItem->associatedModel->primaryImage->name) : ''}}"
                                                                     alt="">
                                                            </div>
                                                            <div class="text-center px-1 px-sm-3">
                                                                <a href="{{ $cartItem->associatedModel->path() }}"
                                                                   target="_blank"><h2>{{ $cartItem->associatedModel->name }}</h2></a>
                                                                <div
                                                                    class="number">قیمت:  {{ $cartItem->price }}  تومان</div>
                                                                <div class="number">تعداد:  {{ $cartItem->quantity }}  عدد</div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </span>
                                                    @endforeach
                                                    <!-- /Order Product Record -->

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <!-- /Orders List -->


                            </div>
                            <div class="col-12 col-lg-3 mt-2 mt-lg-0 pr-3 pr-lg-0">
                                <div id="factor">
                                    <div class="container">
                                        <div class="row py-2">
                                            <div class="col-6">
                                                <div>جمع کل فاکتور:</div>
                                            </div>
                                            <div class="col-6">
                                                <div>
                                                    {{ number_format(\Cart::getTotal()) }}
                                                    تومان
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row py-2 bg-light">
                                            <div class="col-6">
                                                <div>جمع تخفیف:</div>
                                            </div>
                                            <div class="col-6">
                                                <div>
                                                    @php
                                                        $discountAmount = 0;
                                                            if (session()->has('coupon')) $discountAmount += session('coupon')['amount'];
                                                    @endphp
                                                    {{ $discountAmount }}
                                                    تومان
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row py-2">
                                            <div class="col-6">
                                                <div>هزینه ارسال:</div>
                                            </div>
                                            <div class="col-6">
                                                <div class="small">درب منزل با مشتری</div>
                                            </div>
                                        </div>
                                        <div class="row py-2" id="total">
                                            <div class="col-6">
                                                <div>مبلغ قابل پرداخت:</div>
                                            </div>
                                            <div class="col-6">
                                                <div>{{ number_format(\Cart::getTotal() - ( $discountAmount )) }}
                                                    تومان
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <form action="{{ route('front.checkout.check') }}" method="post">
                                        @csrf
                                        <div class="container">
                                            <div class="row py-2">
                                                <div class="col-12">
                                                    <div>انتخاب درگاه پرداخت</div>
                                                </div>
                                            </div>
                                            <div class="row pb-2">
                                                <div class="col-12 pb-2">
                                                    @foreach(config('payment') as $paymentMethod => $paymentInfo)
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input name="payment_method"  type="radio" class="form-check-input" value="{{ ($paymentMethod) }}"
                                                                   name="payment_type"
                                                                   @checked($paymentMethod == 'zarinpal' )>
                                                            {{ $paymentInfo['name'] }}
                                                        </label>
                                                    </div>
                                                    @endforeach

                                                    {{--                                                <div class="form-check">--}}
                                                    {{--                                                    <label class="form-check-label">--}}
                                                    {{--                                                        <input type="radio" class="form-check-input"--}}
                                                    {{--                                                               name="payment_type">ثبت فیش پرداخت/کارت به کارت--}}
                                                    {{--                                                    </label>--}}
                                                    {{--                                                </div>--}}
                                                </div>
                                                {{--                                            <div class="col-12 pb-2" id="rules">--}}
                                                {{--                                                <div class="form-check">--}}
                                                {{--                                                    <label class="form-check-label">--}}
                                                {{--                                                        <input type="checkbox" class="form-check-input"--}}
                                                {{--                                                               name="accept_rules" value="1"><a href="#"--}}
                                                {{--                                                                                                target="_blank">قوانین و--}}
                                                {{--                                                            مقررات</a> را خواندم و قبول دارم.--}}
                                                {{--                                                    </label>--}}
                                                {{--                                                </div>--}}
                                                {{--                                            </div>--}}
                                                <div class="col-12">
                                                    <input type="submit" value="پرداخت و تکمیل خرید"
                                                           class="btn btn-success w-100">
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
        </div>
    </section>

@endsection