@extends('Dashboard::master')
@section('title' , __('Coupon::translation.create'))
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('panel.coupons.index') }}"> @lang('Coupon::translation.index') </a>
    </li>
    <li class="breadcrumb-item active"><a> @lang('Coupon::translation.create')</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-11">
            <div class="card overflow-hidden border border-5">
                <div class="card-header border border-5">
                    <div class="alert alert-primary" role="alert">
                        @lang('Coupon::translation.create')
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('panel.coupons.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="text-capitalize"
                                           for="code"> کد </label>
                                    <input type="text" class="form-control" id="code"
                                           name="code" placeholder="کد" value="{{old("code")}}">
                                    <x-validation-error field="code" />
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="text-capitalize"
                                           for="amount"> نوع </label>
                                    <select name="type" class="form-control">
                                        <option value> نوع تخفیف را انتخاب کنید</option>
                                        @foreach(\Modules\Coupon\Models\Coupon::$types as $name => $value)
                                            <option value="{{ $value }}"
                                            @selected(old('type') == $value)
                                            > {{ $name }} </option>
                                        @endforeach
                                    </select>
                                    <x-validation-error field="type" />
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="text-capitalize"
                                           for="amount"> قیمت </label>
                                    <input type="text" class="form-control" id="amount"
                                           name="amount" placeholder="قیمت" value="{{old("amount")}}">
                                    <x-validation-error field="amount" />

                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="text-capitalize"
                                           for="percent"> درصد </label>
                                    <input type="text" class="form-control" id="percent"
                                           name="percent" placeholder="درصد" value="{{old("percent")}}">
                                    <x-validation-error field="percent" />

                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="text-capitalize"
                                           for="expired_at"> تاریخ اعتبار </label>
                                    <input type="text" class="form-control" id="expired_at"
                                           name="expired_at" placeholder="تاریخ اعتبار"
                                           value="{{old("expired_at")}}">
                                    <x-validation-error field="expired_at" />

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="text-capitalize" for="description"> توضیحات </label>
                                    <textarea class="form-control" name="description" id="description"
                                              rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-uppercase">
                                    <i class="ti-check-box m-l-5"></i>ذخیره
                                </button>
                                <a href="{{ route('panel.coupons.index') }}"
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
    <!-- end row -->
@endsection
