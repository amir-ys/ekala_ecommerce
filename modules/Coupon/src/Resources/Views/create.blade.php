@extends('Dashboard::master')
@section('title' , __('Coupon::translation.create'))
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('panel.coupons.index') }}"> @lang('Coupon::translation.index') </a>
    </li>
    <li class="breadcrumb-item active"><a> @lang('Coupon::translation.create')</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="col-xl-12">
                <div class="card overflow-hidden border border-5">
                    <div class="card-header border border-5">
                        <div class="alert alert-primary" role="alert">
                            @lang('Coupon::translation.create')
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('panel.coupons.store') }}">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-10 mb-3">
                                        <div class="row">
                                            <label for="name" class="col-sm-3 col-form-label">نام</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="name" name="name"
                                                       placeholder="نام"
                                                       value="{{ old('name') }}">
                                                <x-validation-error field="name"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col-md-9 offset-md-3">
                                        <button type="submit" class="btn btn-primary btn-uppercase">
                                            <i class="ti-check-box m-l-5"></i>ذخیره
                                        </button>
                                        <a href="{{ route('panel.coupons.index') }}"
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
    </div>
    <!-- end row -->
@endsection
