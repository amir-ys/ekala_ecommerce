@extends('Dashboard::master')
@section('title'  ,__('Order::translation.orderItems.index'))
@section('breadcrumb')
    <li class="breadcrumb-item active"><a href="{{ route('panel.orders.index') }}">@lang('Order::translation.order.index')</a></li>
    <li class="breadcrumb-item active"><a
            href="{{ route('panel.orders.show' , $order->id) }}">@lang('Order::translation.order.show')</a></li>
    <li class="breadcrumb-item active"><a>@lang('Order::translation.orderItems.index')</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body border border-5">
                        <table class="table table-striped">
                            <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>محصول</th>
                                <th>تعداد</th>
                                <th> مبلغ</th>
                                <th> مبلغ نهایی</th>
                                <th>  رنگ </th>
                                <th>  گارانتی </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orderItems as $item)
                                <tr>
                                    <td>{{ $loop->iteration  }}</td>
                                    <td>{{ $item->product->name  }}</td>
                                    <td>{{ $item->quantity  }}</td>
                                    <td> {{  number_format($item->price) }} </td>
                                    <td> {{  number_format($item->total) }} </td>
                                    <td> {{ $item->color?->color_name ?? '-'   }} </td>
                                    <td> {{ $item->warranty?->name ?? '-'   }} </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <!-- /basic responsive table -->
@endsection
