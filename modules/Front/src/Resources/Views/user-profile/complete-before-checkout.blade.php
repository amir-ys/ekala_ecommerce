@extends('Front::master')
@section('content')

    <section class="inner-page" id="cart-page">
        <div class="container-fluid" id="page-hero">
            <div class="row">
                <div class="col-12">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 px-0">
                                <h1>تکمیل پروفایل</h1>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="./index.html">صفحه نخست</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">تکمیل پروفایل</li>
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
                                    <div class="card border border-2">
                                        <div class="card-body">
                                            <form action="{{ route('front.checkout.profile.complete.save') }}" method="post">
                                                @csrf
                                                <div class="row">

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="col-form-label text-capitalize"
                                                                   for="first_name"> نام  </label>
                                                            <input type="text" class="form-control" id="first_name"
                                                                   name="first_name" placeholder="موضوع" value="{{old("first_name" , auth()->user()->first_name)}}">
                                                            <x-validation-error field="first_name"/>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="col-form-label text-capitalize"
                                                                   for="last_name"> نام خانوادگی </label>
                                                            <input type="text" class="form-control" id="last_name"
                                                                   name="last_name" placeholder="نام" value="{{old("last_name" , auth()->user()->last_name)}}">
                                                            <x-validation-error field="last_name"/>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="col-form-label text-capitalize"
                                                                   for="email"> ایمیل  </label>
                                                            <input type="text" class="form-control" id="email"
                                                                   name="email" placeholder="ایمیل" value="{{old("email" , auth()->user()->email)}}">
                                                            <x-validation-error field="email"/>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="col-form-label text-capitalize"
                                                                   for="mobile"> شماره همراه  </label>
                                                            <input type="text" class="form-control" id="mobile"
                                                                   name="mobile" placeholder="شماره همراه" value="{{old("mobile" , auth()->user()->mobile)}}">
                                                            <x-validation-error field="mobile"/>
                                                        </div>
                                                    </div>

                                                </div>
                                            <div class="row mt-3">
                                                <div class="col-md-12">
                                                    <button type="submit" class="btn btn-success btn-uppercase">
                                                        <i class="ti-check-box m-l-5"></i>ذخیره
                                                    </button>
                                                </div>
                                            </div>
                                            </form>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection