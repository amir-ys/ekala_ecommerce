@extends('Dashboard::master')
@section('title'  ,__('Payment::translation.payment.cash'))
@section('breadcrumb')
    <li class="breadcrumb-item active"><a>@lang('Payment::translation.payment.cash')</a></li>
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
                                <th>  سفارشات </th>
                                <th>  مقدار </th>
                                <th> نام دریافت کننده </th>
                                <th>روش پرداخت </th>
                                <th>وضعیت</th>
                                <th>تاریخ ساخت</th>
                                <th> عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($payments as $payment)
                                <tr>
                                    <td>{{ $loop->iteration  }}</td>
                                    <td>{{ $payment->user?->full_name  }}</td>
                                    <td>
                                    <span class="badge bg-primary text-white">
                                        <a  class="text-white" href="{{ route('panel.payments.orders.index' , $payment->id) }}">سفارشات</a>
                                    </span>
                                    </td>
                                    <td> {{  $payment->amount }} </td>
                                    <td> {{  $payment->cash_receiver ?: '-' }} </td>
                                    <td>
                                        <span CLASS="badge bg-{{ $payment->payment_type_css }}"> {{  $payment->payment_type_name }} </span>
                                    </td>
                                    <td>
                                        <span CLASS="badge bg-{{ $payment->status_css }}"> {{  $payment->status_name }} </span>
                                    </td>
                                    <td>{{ getJalaliDate($payment->created_at) }}</td>
                                    <td>

                                        <a href="{{ route('panel.payments.destroy' , $payment->id) }}"
                                           onclick="deleteItem(event ,  '{{ route('panel.payments.destroy' , $payment->id) }}')"
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
