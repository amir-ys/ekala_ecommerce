@extends('Front::master')
@section('content')

    <section class="inner-page" id="checkout-page">
        <div class="container-fluid" id="page-hero">
            <div class="row">
                <div class="col-12">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 px-0">
                                <h1>انتخاب آدرس </h1>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="/">صفحه نخست</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">انتخاب آدرس </li>
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
                                                <div class="row d-flex justify-content-between">
                                                    <div class="col-md-4">
                                                        <div class="pb-1 title">آدرس تحویل سفارش</div>
                                                    </div>
                                                    <div class="col-md-4"></div>
                                                    <div class="col-md-4">
                                                        <a target="_blank"
                                                           href="{{ route('front.user.addresses.index') }}">
                                                            <div
                                                                class="btn btn-outline-dark mt-0 mt-md-1 w-100">
                                                                افزودن آدرس جدید
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-12 col-md-12 pl-0" id="address-detail">
                                                        @foreach($userAddresses as $address)
                                                            <div class="row d-flex justify-content-between">
                                                                <label for="address-id-{{ $address->id }}"
                                                                       onclick="setAddressClass('{{ $address->id }}')">
                                                                    <div id="division-{{ $address->id }}"
                                                                         class="col-md-11 border rounded-5 mb-1  @if($address->is_active) bg-sky-blue @endif">
                                                                        <div
                                                                            class="p-3 ml-3 mb-2 mb-md-0 ml-md-0 address-to-send">
                                                                            <div class="address-title">
                                                                            <span
                                                                                id="province-title">{{ $address->province->name }}</span>،
                                                                                <span
                                                                                    id="city-title">{{ $address->city->name }}</span>،
                                                                                <span
                                                                                    id="address">{{ $address->address }}</span>،
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-12 col-md-4">
                                                                                    کدپستی: {{ $address->postal_code }}
                                                                                </div>
                                                                                <div class="col-12 col-md-8">تحویل
                                                                                    گیرنده:
                                                                                    {{ $address->receiver }} |
                                                                                    {{ $address->phone_number }}
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        <input id="address-id-{{ $address->id }}"
                                                                               name="address_id" type="radio"  @if($address->is_active) checked @endif
                                                                               value="{{ $address->id }}" form="save-address-form"
                                                                               class="d-none">
                                                                    </div>
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>

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
                                                    {{ number_format(\Modules\Front\Services\CartService::getTotal()) }}
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
                                                    {{ number_format( $discountAmount = $getDiscountAmount = getDiscountAmount())  }}                                                    تومان
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
                                                <div>{{ number_format(\Modules\Front\Services\CartService::getTotal() - ( $discountAmount )) }}
                                                    تومان
                                                </div>
                                            </div>
                                        </div>
                                    <hr>
                                    <form method="post" action="{{ route('front.checkout.saveAddress') }}"
                                            id="save-address-form">
                                        @csrf
                                    </form>
                                    <a class="btn btn-success w-100 mb-3" onclick="event.preventDefault();document.getElementById('save-address-form').submit()" >
                                        ادامه فرایند خرید
                                    </a>
                                    </div>
{{--                                    <form action="{{ route('front.checkout.check') }}" method="post">--}}
{{--                                        @csrf--}}
{{--                                        <div class="container">--}}
{{--                                            <div class="row py-2">--}}
{{--                                                <div class="col-12">--}}
{{--                                                    <div>انتخاب درگاه پرداخت</div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="row pb-2">--}}
{{--                                                <div class="col-12 pb-2">--}}
{{--                                                    @foreach(config('payment') as $paymentMethod => $paymentInfo)--}}
{{--                                                        <div class="form-check">--}}
{{--                                                            <label class="form-check-label">--}}
{{--                                                                <input name="payment_method" type="radio"--}}
{{--                                                                       class="form-check-input"--}}
{{--                                                                       value="{{ ($paymentMethod) }}"--}}
{{--                                                                       name="payment_type"--}}
{{--                                                                    @checked($paymentMethod == 'zarinpal' )>--}}
{{--                                                                {{ $paymentInfo['name'] }}--}}
{{--                                                            </label>--}}
{{--                                                        </div>--}}
{{--                                                    @endforeach--}}

{{--                                                    --}}{{--                                                <div class="form-check">--}}
{{--                                                    --}}{{--                                                    <label class="form-check-label">--}}
{{--                                                    --}}{{--                                                        <input type="radio" class="form-check-input"--}}
{{--                                                    --}}{{--                                                               name="payment_type">ثبت فیش پرداخت/کارت به کارت--}}
{{--                                                    --}}{{--                                                    </label>--}}
{{--                                                    --}}{{--                                                </div>--}}
{{--                                                </div>--}}
{{--                                                --}}{{--                                            <div class="col-12 pb-2" id="rules">--}}
{{--                                                --}}{{--                                                <div class="form-check">--}}
{{--                                                --}}{{--                                                    <label class="form-check-label">--}}
{{--                                                --}}{{--                                                        <input type="checkbox" class="form-check-input"--}}
{{--                                                --}}{{--                                                               name="accept_rules" value="1"><a href="#"--}}
{{--                                                --}}{{--                                                                                                target="_blank">قوانین و--}}
{{--                                                --}}{{--                                                            مقررات</a> را خواندم و قبول دارم.--}}
{{--                                                --}}{{--                                                    </label>--}}
{{--                                                --}}{{--                                                </div>--}}
{{--                                                --}}{{--                                            </div>--}}
{{--                                                <div class="col-12">--}}
{{--                                                    <input type="submit" value="ادامه فرایند پرداخت"--}}
{{--                                                           class="btn btn-success w-100">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </form>--}}
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
        function setAddressClass(id) {
            var addresses = {!! $userAddresses !!};
            addresses.map((address) => {
                $('#division-' + address.id).removeClass('bg-sky-blue')
            })
            $('#division-' + id).addClass('bg-sky-blue')
        }
    </script>
@endsection
