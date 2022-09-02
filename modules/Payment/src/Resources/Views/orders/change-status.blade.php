@extends('Dashboard::master')
@section('title' , __('Order::translation.order.changeStatus'))
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('panel.orders.index') }}"> @lang('Order::translation.order.index') </a></li>
    <li class="breadcrumb-item active"><a> @lang('Order::translation.order.changeStatus')</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="col-xl-12">
                <div class="card overflow-hidden border border-5">
                    <div class="card-header border border-5">
                        <div class="alert alert-primary" role="alert">
                            @lang('Order::translation.order.changeStatus')
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('panel.orders.changeStatus' , $order->id) }}">
                            @csrf
                            @method('patch')
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="col-form-label"> وضعیت </label>
                                    <div class="form-group">
                                        <select class="form-control" name="status" aria-hidden="true">
                                            <option value>یک وضعیت را انتخاب کنید</option>
                                            @foreach(\Modules\Payment\Models\Order::$statuses as $name =>  $status)
                                                <option value="{{ $status }}"
                                                @selected($status == $order->status)
                                                >{{ $name }}</option>
                                            @endforeach
                                        </select>
                                        <x-validation-error field="status"/>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <label class="col-form-label"> وضعیت ارسال </label>
                                    <div class="form-group">
                                        <select class="form-control" name="delivery_status" aria-hidden="true">
                                            <option value>یک وضعیت ارسال را انتخاب کنید</option>
                                            @foreach(\Modules\Payment\Models\Order::$deliveryStatuses as $name =>  $status)
                                                <option value="{{ $status }}"
                                                @selected($status == $order->delivery_status)
                                                >{{ $name }}</option>
                                            @endforeach
                                        </select>
                                        <x-validation-error field="delivery_status"/>
                                    </div>
                                </div>

                            </div>
                                <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-uppercase">
                                        <i class="ti-check-box m-l-5"></i>ذخیره
                                    </button>
                                    <a href="{{ route('panel.orders.index') }}"
                                       class="btn btn-secondary waves-effect">
                                        بازگشت
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
