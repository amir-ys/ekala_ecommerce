@extends('Dashboard::master')
@section('title' , __('Discount::translation.commonDiscount.edit'))
@section('breadcrumb')
    <li class="breadcrumb-item"><a
            href="{{ route('panel.commonDiscounts.index') }}"> @lang('Discount::translation.commonDiscount.index') </a>
    </li>
    <li class="breadcrumb-item active"><a> @lang('Discount::translation.commonDiscount.edit')</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-11">
            <div class="card overflow-hidden border border-5">
                <div class="card-header border border-5">
                    <div class="alert alert-primary" role="alert">
                        @lang('Discount::translation.commonDiscount.edit')
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('panel.commonDiscounts.update'  , $discount->id) }}">
                        @csrf
                        @method('patch')
                        <div class="row">

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="text-capitalize"
                                           for="title"> موضوع </label>
                                    <input type="text" class="form-control" id="title"
                                           name="title" placeholder="موضوع" value="{{old("title" , $discount->title)}}">
                                    <x-validation-error field="title"/>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="text-capitalize"
                                           for="percent"> درصد </label>
                                    <input type="text" class="form-control" id="percent"
                                           name="percent" placeholder="درصد"
                                           value="{{old("percent" , $discount->percent)}}">
                                    <x-validation-error field="percent"/>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="text-capitalize"
                                           for="discount_ceiling"> حداکثر تخفیف مبلفی </label>
                                    <input type="text" class="form-control" id="discount_ceiling"
                                           name="discount_ceiling" placeholder="حداکثر تخفیف مبلفی"
                                           value="{{old("discount_ceiling" , $discount->discount_ceiling)}}">
                                    <x-validation-error field="discount_ceiling"/>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="text-capitalize"
                                           for="minimal_order_amount"> کمتربن مقدار سفارش </label>
                                    <input type="text" class="form-control" id="minimal_order_amount"
                                           name="minimal_order_amount" placeholder="کمتربن مقدار سفارش"
                                           value="{{old("minimal_order_amount" , $discount->minimal_order_amount)}}">
                                    <x-validation-error field="minimal_order_amount"/>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="text-capitalize"
                                           for="start_date"> تاریخ شروع</label>
                                    <input type="date" class="form-control" id="start_date"
                                           name="start_date" placeholder="تاریخ شروع"
                                           value="{{old("start_date" , $discount->start_date)}}">
                                    <x-validation-error field="start_date"/>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="text-capitalize"
                                           for="end_date"> تاریخ پایان </label>
                                    <input type="date" class="form-control" id="end_date"
                                           name="end_date" placeholder="تاریخ پایان "
                                           value="{{old("end_date" , $discount->end_date)}}">
                                    <x-validation-error field="end_date"/>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <label class="col-form-label"> وضعیت </label>
                                <div class="form-group">
                                    <select class="form-control" name="status" aria-hidden="true">
                                        <option value>یک وضعیت را انتخاب کنید</option>
                                        @foreach(\Modules\Coupon\Models\CommonDiscount::$statuses as $name =>  $status)
                                            <option value="{{ $status }}"
                                                @selected($status == $discount->status)
                                            >{{ $name }}</option>
                                        @endforeach
                                    </select>
                                    <x-validation-error field="status"/>
                                </div>
                            </div>

                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-uppercase">
                                    <i class="ti-check-box m-l-5"></i>بروزرسانی
                                </button>
                                <a href="{{ route('panel.commonDiscounts.index') }}"
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
