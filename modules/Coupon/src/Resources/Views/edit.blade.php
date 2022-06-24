@extends('Dashboard::master')
@section('title' ,__('Coupon::translation.edit'))
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('panel.coupons.index') }}"> @lang('Coupon::translation.index') </a>
    </li>
    <li class="breadcrumb-item active"><a> @lang('Coupon::translation.edit') {{ $coupon->name }}</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="col-xl-12">
                <div class="card overflow-hidden border border-5">
                    <div class="card-header border border-5">
                        <div class="alert alert-primary" role="alert">
                            <div class="row">
                                <div class="col-md-6">
                                    @lang('Coupon::translation.edit') "{{ $coupon->name }}"
                                </div>
                                <div class="col-md-6">
                                    <div class="font-size-12 text-left"> تاریخ اخرین بروزرسانی
                                        : {{ getJalaliDate($coupon->updated_at) }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('panel.coupons.update' , $coupon->id) }}">
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-10 mb-3">
                                        <div class="row">
                                            <label for="name" class="col-sm-3 col-form-label">نام</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="name" name="name"
                                                       placeholder="نام"
                                                       value="{{ old('name' , $coupon->name) }}">
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
                                            <i class="ti-check-box m-l-5"></i>بروزرسانی
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
