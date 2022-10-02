@extends('Dashboard::master')
@section('title'  ,__('Order::translation.order.show'))
@section('breadcrumb')
    <li class="breadcrumb-item active"><a href="{{ route('panel.orders.index') }}">@lang('Order::translation.order.index')</a></li>
    <li class="breadcrumb-item active"><a>@lang('Order::translation.order.show')</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body border border-5">
                        <table id="printable" class="table">
                            <thead id="thead-c">
                            <tr>
                                <td>
                                    <a href="#" onclick="printContent(event)" class="btn btn-primary btn-sm text-white">
                                        چاپ<i class="fa fa-fw fa-print"> </i>
                                    </a>
                                    <a href="{{ route('panel.orders.details' , $order->id) }}" class="btn btn-warning btn-sm text-white">
                                        جزِییات<i class="fa fa-fw fa-info"> </i>
                                    </a>
                                </td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th> شماره فاکتور</th>
                                <td class="text-left">{{ $order->id }}</td>
                            </tr>
                            <tr>
                                <th>نام مشتری</th>
                                <td class="text-left">{{ $order->user->username }}</td>
                            </tr>
                            <tr>
                                <th> آدرس مشتری</th>
                                <td class="text-left">{{ $order->userAddress->get_full_address }}</td>
                            </tr>

                            <tr>
                                <th> اطلاعات گیرنده سفارش</th>
                                <td class="text-left">{{ $order->userAddress->get_address_receiver }}</td>
                            </tr>

                            <tr>
                                <th> نوع پرداخت </th>
                                <td class="text-left">
                                    <span CLASS="badge bg-{{ $order->payment->payment_type_css }}"> {{  $order->payment->payment_type_name }} </span>
                                </td>
                            </tr>

                            <tr>
                                <th> وضعیت پرداخت </th>
                                <td class="text-left">
                                    <span CLASS="badge bg-{{ $order->payment->status_css }}"> {{  $order->payment->status_name }} </span>
                                </td>
                            </tr>

                            <tr>
                                <th> وضعیت ارسال </th>
                                <td class="text-left">
                                    <span CLASS="badge bg-{{ $order->delivery_status_css }}"> {{  $order->delivery_status_name }} </span>
                                </td>
                            </tr>

                            <tr>
                                <th> مبلغ و تاریخ ارسال </th>
                                <td class="text-left">

                                    <span> {{  getJalaliDate($order->delivery_date , 'Y-m-d H:i:s' , 'H:i Y-m-d') }} </span>
                                </td>
                            </tr>

                            <tr>
                                <th> مجموع مبلغ سفارش (بدون تخفیف) </th>
                                <td class="text-left">
                                    {{ $order->final_amount }}
                                </td>
                            </tr>

                            <tr>
                                <th>مجموع مبلغ  تخفیفات </th>
                                <td class="text-left">
                                    {{ $order->discount_amount }}
                                </td>
                            </tr>



                            <tr>
                                <th>   مبلغ  نهایی</th>
                                <td class="text-left">
                                    {{  $order->final_amount - $order->discount_amount   }}
                                </td>
                            </tr>

                            <tr>
                                <th> کوپن استفاده شده</th>
                                <td class="text-left">
                                    {{  optional($order->coupon)->code ?: '-'  }}
                                </td>
                            </tr>


                            <tr>
                                <th>مبلغ کوپن </th>
                                <td class="text-left">
                                    {{  $order->coupon_discount_amount ?? '-'  }}
                                </td>
                            </tr>

                            <tr>
                                <th>تخفیف عمومی استفاده شده  </th>
                                <td class="text-left">
                                    {{  $order->commonDiscount ? $order->commonDiscount->title : '-'  }}
                                </td>
                            </tr>

                            <tr>
                                <th>مبلغ تخفیف عمومی استفاده شده </th>
                                <td class="text-left">
                                    {{  $order->common_discount_amount ?? '-' }}
                                </td>
                            </tr>

                            <tr>
                                <th>وضعیت سفارش </th>
                                <td class="text-left">
                                    <span CLASS="badge bg-{{ $order->status_css }}"> {{  $order->status_name }} </span>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <!-- /basic responsive table -->
@endsection
@section('script')
    <script>
        function printContent(event) {
            event.preventDefault();
           var body =  $('body').html()
           var printContent =  $('#printable thead').empty();
            printContent =  $('#printable').clone();
            $('body').empty().html(printContent);
           window.print()
            $('body').html(body);
        }
    </script>
@endsection
