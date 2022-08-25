@extends('Dashboard::master')
@section('title'  ,__('Payment::translation.order.online'))
@section('breadcrumb')
    <li class="breadcrumb-item active"><a>@lang('Payment::translation.order.online')</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body border border-5">
                    <div class="table-responsive">
                        <table id="table" class="table table-hover">
                            <thead class="thead-light">
                            <tr>
                                <th>شناسه</th>
                                <th>کاربر</th>
                                <th>  مقدار اصلی  </th>
                                <th>  مقدار تخفیف </th>
                                <th>  مقدار قابل پرداخت </th>
                                <th> نام درگاه </th>
                                <th>روش پرداخت </th>
                                <th>وضعیت</th>
                                <th>تاریخ ساخت</th>
                                <th> عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{ $loop->iteration  }}</td>
                                    <td>{{ $order->user?->full_name  }}</td>
                                    <td> {{  $order->total_amount }} </td>
                                    <td> {{  $order->coupon_amount }} </td>
                                    <td> {{  $order->paying_amount }} </td>
                                    <td>
                                        <span CLASS="badge bg-{{ $order->order_type_css }}"> {{  $order->order_type_name }} </span>
                                    </td>
                                    <td>
                                        <span CLASS="badge bg-{{ $order->status_css }}"> {{  $order->status_name }} </span>
                                    </td>
                                    <td>{{ getJalaliDate($order->created_at) }}</td>
                                    <td>

                                        <a href="{{ route('panel.orders.destroy' , $order->id) }}"
                                           onclick="deleteItem(event ,  '{{ route('panel.orders.destroy' , $order->id) }}')"
                                           class="btn btn-sm bg-transparent d-inline delete-confirm"><i
                                                class="fa fa-trash fa-15m text-danger"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /basic responsive table -->
@endsection
