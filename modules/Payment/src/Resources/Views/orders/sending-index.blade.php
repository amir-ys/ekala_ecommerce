@extends('Dashboard::master')
@section('title'  ,__('Order::translation.order.sendingIndex'))
@section('breadcrumb')
    <li class="breadcrumb-item active"><a>@lang('Order::translation.order.sendingIndex')</a></li>
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
                                <th>#</th>
                                <th>کد سفارش</th>
                                <th>کاربر</th>
                                <th>مجموع مبلغ سفارش (بدون تخفیف) </th>
                                <th>  مجموع مبلغ  تخفیفات </th>
                                <th>  مبلغ  نهایی </th>
                                <th> وضعیت پرداخت  </th>
                                <th> شیوه پرداخت  </th>
                                <th> وضعیت ارسال  </th>
                                <th> وضعیت سفارش  </th>
                                <th> عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{ $loop->iteration  }}</td>
                                    <td>{{ $order->id  }}</td>
                                    <td>{{ $order->user?->username  }}</td>
                                    <td> {{  $order->final_amount }} </td>
                                    <td> {{  $order->discount_amount }} </td>
                                    <td> {{  $order->final_amount - $order->discount_amount   }} </td>
                                    <td>
                                        <span CLASS="badge bg-{{ $order->payment->status_css }}"> {{  $order->payment->status_name }} </span>
                                    </td>
                                    <td>
                                        <span CLASS="badge bg-{{ $order->payment->payment_type_css }}"> {{  $order->payment->payment_type_name }} </span>
                                    </td>
                                    <td>
                                        <span CLASS="badge bg-{{ $order->delivery_status_css }}"> {{  $order->delivery_status_name }} </span>
                                    </td>
                                    <td>
                                        <span CLASS="badge bg-{{ $order->status_css }}"> {{  $order->status_name }} </span>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn  dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                                <i class="fa fa-gear fa-15m text-secondary"></i></a>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(204px, 36px, 0px);">
                                                <a class="dropdown-item" href="{{ route('panel.orders.show' , $order->id) }}">مشاهده فاکتور</a>
                                                @if(auth()->user()->hasPermissionTo(\Modules\RolePermissions\Models\Permission::PERMISSION_MANAGE_PAYMENTS))
                                                    <a class="dropdown-item" href="{{ route('panel.orders.changeStatus.page' , $order->id) }}">تغییر وضعیت سفارش </a>
                                                @endif
                                            </div>
                                        </div>
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
