@extends('Dashboard::master')
@section('title' , __('Product::translation.delivery.create'))
@section('breadcrumb')
    <li class="breadcrumb-item"><a
            href="{{ route('panel.delivery.index') }}"> @lang('Product::translation.delivery.index') </a>
    </li>
    <li class="breadcrumb-item active"><a> @lang('Product::translation.delivery.create')</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card overflow-hidden border border-5">
                <div class="card-header border border-5">
                    <div class="alert alert-primary" role="alert">
                        @lang('Product::translation.delivery.create')
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('panel.delivery.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>نام</label>
                                    <input type="text" class="form-control" name="name"
                                           placeholder="نام"
                                           value="{{ old('name') }}">
                                    <x-validation-error field="name"/>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>قیمت</label>
                                    <input type="number" class="form-control" name="amount"
                                           placeholder="قیمت"
                                           value="{{ old('amount') }}">
                                    <x-validation-error field="amount"/>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>زمان ارسال</label>
                                    <input type="text" class="form-control" name="delivery_time"
                                           placeholder="زمان ارسال"
                                           value="{{ old('delivery_time') }}">
                                    <x-validation-error field="delivery_time"/>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label>واحد زمان ارسال </label>
                                    <input type="text" class="form-control" name="delivery_unit"
                                           placeholder="واحد زمان ارسال "
                                           value="{{ old('delivery_unit') }}">
                                    <x-validation-error field="delivery_unit"/>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label>وضعیت</label>
                                    <select class="form-control" name="status">
                                        <option value> یک وضعیت را انتخاب کنید</option>
                                        @foreach(\Modules\Product\Models\Delivery::$statuses as $name =>  $status)
                                            <option value="{{ $status }}"
                                            > {{ $name }} </option>
                                        @endforeach
                                    </select>
                                    <x-validation-error field="status"/>
                                </div>


                            </div>
                        </div>
                        <hr>
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-9">
                                    <button type="submit" class="btn btn-primary btn-uppercase">
                                        <i class="ti-check-box m-l-5"></i>ذخیره
                                    </button>
                                    <a href="{{ route('panel.delivery.index') }}"
                                       class="btn btn-secondary waves-effect">
                                        بازگشت
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection
