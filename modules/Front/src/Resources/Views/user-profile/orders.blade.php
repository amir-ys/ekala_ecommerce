@extends('Front::master')
@section('content')
    <section class="inner-page" id="profile-page">
        <div class="container-fluid" id="page-hero">
            <div class="row">
                <div class="col-12">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 px-0">
                                <h1>ناحیه کاربری</h1>
                                <p>به ناحیه کاربری روبیک مارکت خوش آمدید.</p>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="../index.html">صفحه نخست</a></li>
                                        <li class="breadcrumb-item"><a href="#">ناحیه کاربری</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">سفارشات</li>
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
                            <div class="col-12 col-lg-3">
                                <!-- Side Panel -->
                                @include('Front::partials.user-profile-sidebar')
                                <!-- /Side Panel -->
                            </div>
                            <div class="col-12 col-lg-9 pl-lg-0 pr-lg-2 mt-2 mt-lg-0">
                                <!-- Factors Count -->
                                <div class="custom-container" id="orders-status">
                                    <div class="container nowrap">
                                        <div class="row py-2">
                                            <div class="col-12 px-0">
                                                <ul class="px-3">
                                                    <li>
                                                        <a href="{{ route('front.user.orders.index') }}?status={{ \Modules\Payment\Models\Order::STATUS_PENDING }}"
                                                class="{{ request()->query('status') == \Modules\Payment\Models\Order::STATUS_PENDING ? 'active' : '' }}">
                                                            <span>در انتظار پرداخت</span>
                                                            <div class="badge badge-secondary">1</div>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('front.user.orders.index') }}?status={{ \Modules\Payment\Models\Order::STATUS_PAID  }}"
                                                                  class="{{ request()->query('status') == \Modules\Payment\Models\Order::STATUS_PAID ? 'active' : '' }}"          >
                                                            <span>پرداخت شده</span>
                                                            <div class="badge badge-secondary">2</div>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('front.user.orders.index') }}?status={{ \Modules\Payment\Models\Order::DELIVERY_STATUS_POSTED }}"
                                                                         class="{{ request()->query('status') == \Modules\Payment\Models\Order::DELIVERY_STATUS_POSTED ? 'active' : '' }}"           >
                                                            <span>ارسال شده</span>
                                                            <div class="badge badge-secondary">3</div>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Factors Count -->

                                <!-- Factors List -->
                                <div class="custom-container mt-2 order">
                                    <hr>
                                    <div class="container">
                                        <div class="row ">
                                            <div class="table-responsive">
                                                    <table id="table"  class="table table-hover table-borderless"   >
    <thead>

                                                        <tr>
                                                            <th> شناسه سفارش </th>
                                                            <th> تاریخ سفارش</th>
                                                            <th> نوع پرداخت </th>
                                                            <th>  کد تخفیف </th>
                                                            <th> مبلغ </th>
                                                            <th> وضعیت پرداخت </th>
                                                            <th> وضعیت ارسال </th>
                                                            <th> عملیات </th>
                                                        </tr>
    </thead>
    <tbody>
    @foreach($orders as $order)
    <tr>
    <td> {{ $order->id }} </td>
    <td> {{ getJalaliDate($order->created_at) }} </td>
    <td> {{ $order->payment?->payment_type_name }} </td>
    <td> {{ $order->coupon_id ? $order->coupon_amount : '-'  }} </td>
    <td> {{ $order->final_amount }} </td>
    <td class="badge bg-{{ $order->status_css }}"> {{ $order->status_name }} </td>
    <td class="border text-{{ $order->delivery_status_css }}" > {{ $order->delivery_status_name }} </td>
        <td><a  href="#order-{{ $order->id }}" data-bs-toggle="modal" data-bs-target="#order-{{ $order->id }}" ><i class="fa fa-eye"></i></a>
    @include('Front::user-profile.partials.order-items-modal')
    </td>
    </tr>
@endforeach
    </tbody>
                                                       </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Factors List -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

{{--@foreach($orders as $order)--}}
{{--    @foreach($order->items as $orderItem)--}}
{{--        @include('Front::partials.product-box' , ['product' => $orderItem->product  , 'discount' => false ])--}}
{{--    @endforeach--}}
{{--@endforeach--}}
