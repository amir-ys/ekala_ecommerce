@extends('Front::master')
@section('content')
    <section class="inner-page" id="checkout-page">
        <div class="container-fluid" id="page-hero">
            <div class="row">
                <div class="col-12">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 px-0">
                                <h1> پرداخت </h1>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="/">صفحه نخست</a></li>
                                        <li class="breadcrumb-item active" aria-current="page"> پرداخت</li>
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
                                            <div class="col-md-12 py-3">
                                                <div class="row">
                                                        <div class="pb-1 title">کد تخفیف</div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12" id="address-detail">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="input-group input-group-sm">
                                                                    <form action="{{ route('front.coupon.check') }}" method="post" id="coupon_form">
                                                                        @csrf
                                                                        <input type="text" name="code" class="form-control w-100"
                                                                               placeholder="کد تخفیف را وارد کنید" >
                                                                    </form>
                                                                        <button type="submit" form="coupon_form" class="btn btn-primary w-25">اعمال کد</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <section class="mt-3" id="orders">
                                    <div class="container mt-2">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="pb-1 title">انتخاب نوع پرداخت</div>
                                            </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                  <div id="payment_type_online_box" class="col-md-6 border  border-2 bg-sky-blue">
                                                                      <input type="radio" name="payment_type" class="d-none" checked form="checkout-form"
                                                                             value="{{ Modules\Payment\Models\Payment::PAYMENT_TYPE_ONLINE }}" id="payment_type_online">
                                                                      <label for="payment_type_online" class="col-md-12  mt-md-2">
                                                                          <section class="mb-2">
                                                                              <i class="fa fa-credit-card mx-1"></i>
                                                                              پرداخت آنلاین
                                                                          </section>
                                                                          <section class="mb-2">
                                                                              <i class="fa fa-calendar-alt mx-1"></i>
                                                                              درگاه پرداخت زرین پال
                                                                          </section>
                                                                      </label>

                                                                  </div>
                                                                  <div id="payment_type_offline_box" class="col-md-6 border   mr-md-2">
                                                                      <input type="radio" name="payment_type"  class="d-none" form="checkout-form"
                                                                             value="{{ Modules\Payment\Models\Payment::PAYMENT_TYPE_OFFLINE }}" id="payment_type_offline">
                                                                      <label for="payment_type_offline" class="col-md-12 mt-md-2">
                                                                          <section class="mb-2">
                                                                              <i class="fa fa-id-card-alt mx-1"></i>
                                                                              پرداخت آفلاین
                                                                          </section>
                                                                          <section class="mb-2">
                                                                              <i class="fa fa-calendar-alt mx-1"></i>
                                                                              حداکثر در 2 روز کاری بررسی می شود
                                                                          </section>
                                                                      </label>

                                                                  </div>
                                                            </div>
                                                        </div>
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
                                                    {{ number_format(\Modules\Cart\Facades\CartServiceFacade::getTotal()) }}
                                                    تومان
                                                </div>
                                            </div>
                                        </div>

                                            <div class="row py-2 bg-light border-top">
                                                <div class="col-6">
                                                    <div> تخفیف کالا:</div>
                                                </div>
                                                <div class="col-6">
                                                    <div>
                                                        {{ number_format( getDiscountAmount())  }}                                                    تومان
                                                    </div>
                                                </div>
                                            </div>

                                        @if(!is_null($order->common_discount_id))
                                            <div class="row py-2 bg-light border-top">
                                                <div class="col-6">
                                                    <div> تخفیف عمومی:</div>
                                                </div>
                                                <div class="col-6">
                                                    <div>
                                                        {{ number_format( $order->common_discount_amount)  }}                                                    تومان
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        @if(!is_null($order->common_discount_id))
                                            <div class="row py-2 bg-light border-bottom">
                                                <div class="col-6">
                                                    <div> حداقل مبلغ سفارش :</div>
                                                </div>
                                                <div class="col-6">
                                                    <div>
                                                        {{ number_format( $order->commonDiscount->minimal_order_amount)  }}                                                    تومان
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        @if(!is_null($order->coupon_id))
                                            <div class="row py-2 bg-light">
                                                <div class="col-6">
                                                    <div>  کد تخفیف :</div>
                                                </div>
                                                <div class="col-6">
                                                    <div>
                                                        {{  $order->coupon->code  }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        @if(!is_null($order->coupon_id))
                                            <div class="row py-2 bg-light border-bottom">
                                                <div class="col-6">
                                                    <div> مقدار تخفیف  :</div>
                                                </div>
                                                <div class="col-6">
                                                    <div>
                                                        {{ number_format( $order->coupon_discount_amount)  }}                                                    تومان
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="row py-2 bg-light border-bottom">
                                            <div class="col-6">
                                                <div>جمع تخفیف:</div>
                                            </div>
                                            <div class="col-6">
                                                <div>
                                                    {{ number_format( $order->total_discount_amount)  }}                                                    تومان
                                                </div>
                                            </div>
                                        </div>
{{--                                        <div class="row py-2">--}}
{{--                                            <div class="col-6">--}}
{{--                                                <div>هزینه ارسال:</div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-6">--}}
{{--                                                <div class="small">درب منزل با مشتری</div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                        <div class="row py-2" id="total">
                                            <div class="col-6">
                                                <div>مبلغ قابل پرداخت:</div>
                                            </div>
                                            <div class="col-6">
                                                <div>{{ number_format($order->final_amount) }}
                                                    تومان
                                                </div>
                                            </div>
                                        </div>
                                    <hr>
                                    <form method="post" action="{{ route('front.checkout.check') }}"
                                            id="checkout-form">
                                        @csrf
                                    </form>
                                    <a class="btn btn-success w-100 mb-3" onclick="event.preventDefault();document.getElementById('checkout-form').submit()" >
                                        ادامه فرایند خرید
                                    </a>
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
@section('script')
    <script>
        $("input[name='payment_type']").click(function (){
            if (this.value == '{{ Modules\Payment\Models\Payment::PAYMENT_TYPE_OFFLINE }}'){
                $('#payment_type_offline_box').addClass('bg-sky-blue')
                $('#payment_type_online_box').removeClass('bg-sky-blue')
            }else if(this.value == '{{ Modules\Payment\Models\Payment::PAYMENT_TYPE_ONLINE }}'){
                $('#payment_type_online_box').addClass('bg-sky-blue')
                $('#payment_type_offline_box').removeClass('bg-sky-blue')
            }
        })
    </script>
@endsection
