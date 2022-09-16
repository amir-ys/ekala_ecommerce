@extends('Dashboard::master')
@section('title' , __('Coupon::translation.create'))
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('panel.coupons.index') }}"> @lang('Coupon::translation.index') </a>
    </li>
    <li class="breadcrumb-item active"><a> @lang('Coupon::translation.create')</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
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
                                    <x-validation-error field="code"/>
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
                                    <x-validation-error field="type"/>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="text-capitalize"
                                           for="amount"> قیمت </label>
                                    <input type="text" class="form-control" id="amount"
                                           name="amount" placeholder="قیمت" value="{{old("amount")}}">
                                    <x-validation-error field="amount"/>

                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="text-capitalize"
                                           for="percent"> درصد </label>
                                    <input type="text" class="form-control" id="percent"
                                           name="percent" placeholder="درصد" value="{{old("percent")}}">
                                    <x-validation-error field="percent"/>

                                </div>
                            </div>


                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="text-capitalize"
                                           for="start_date"> تاریخ شروع </label>
                                    <input type="text" class="form-control" id="start_date"
                                           name="start_date" placeholder="تاریخ شروع"
                                           value="{{old("start_date")}}">
                                    <x-validation-error field="start_date"/>

                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="text-capitalize"
                                           for="end_date"> تاریخ پایان </label>
                                    <input type="text" class="form-control" id="end_date"
                                           name="end_date" placeholder="تاریخ پایان"
                                           value="{{old("end_date")}}">
                                    <x-validation-error field="end_date"/>

                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="text-capitalize"
                                           for="discount_ceiling"> حداکثر تخفیف مبلفی </label>
                                    <input type="text" class="form-control" id="discount_ceiling"
                                           name="discount_ceiling" placeholder="حداکثر تخفیف مبلفی"
                                           value="{{old("discount_ceiling")}}">
                                    <x-validation-error field="discount_ceiling"/>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="text-capitalize"
                                           for="use_type"> نوع استفاده </label>
                                    <select name="use_type" class="form-control" id="use_type">
                                        <option value> نوع استفاده را انتخاب کنید</option>
                                        @foreach(\Modules\Coupon\Models\Coupon::$useTypes as $name => $value)
                                            <option value="{{ $value }}"
                                                @selected(old('use_type') == $value)
                                            > {{ $name }} </option>
                                        @endforeach
                                    </select>
                                    <x-validation-error field="use_type"/>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="text-capitalize"
                                           for="user_type"> کاربران </label>
                                    <select name="user_id" class="form-control" id="user_select" disabled>
                                        <option value> یک کاربر را انتخاب کنید</option>
                                        @foreach($users as  $user)
                                            <option value="{{ $user->id }}"
                                                @selected(old('user_id') == $value)
                                            > {{ empty($user->email) ? $user->username : $user->email  }}({{ $user->id }})</option>
                                        @endforeach
                                    </select>
                                    <x-validation-error field="user_id"/>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="text-capitalize"
                                           for="amount"> وضعیت </label>
                                    <select name="status" class="form-control">
                                        <option value> نوع وضعیت را انتخاب کنید</option>
                                        @foreach(\Modules\Coupon\Models\Coupon::$statuses as $name => $value)
                                            <option value="{{ $value }}"
                                                @selected(old('status') == $value)
                                            > {{ $name }} </option>
                                        @endforeach
                                    </select>
                                    <x-validation-error field="status"/>
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
@section('css')
    <link rel="stylesheet" href="/assets/panel/vendor/persian-datepicker/persian-datepicker.min.css" type="text/css">
@endsection

@section('script')
    <script>
        $('#use_type').change(function () {
           if( $('#use_type').find(':selected').val() == '{{ \Modules\Coupon\Models\Coupon::USE_TYPE_PUBLIC }}' ){
               $('#user_select').attr('disabled' , 'disabled');
           }else{
               $('#user_select').removeAttr('disabled');
           }
        })
    </script>

    <script src="/assets/panel/vendor/persian-datepicker/persian-date.min.js"></script>
    <script src="/assets/panel/vendor/persian-datepicker/persian-datepicker.min.js"></script>
    <script>


        $('#start_date').persianDatepicker({
            observer: true,
            initialValue: false,
            initialValueType: 'persian' ,
            format: 'YYYY/MM/DD HH:mm',
            timePicker  : {
                enabled : true ,
                second : {
                    enabled : false,
                }
            }
        });

        $('#end_date').persianDatepicker({
            observer: true,
            initialValue: false,
            format: 'YYYY/MM/DD HH:mm',
            initialValueType: 'persian' ,
            timePicker  : {
                enabled : true ,
                second : {
                    enabled : false,
                }
            }
        });

    </script>

@endsection

