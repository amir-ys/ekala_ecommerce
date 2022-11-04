@extends('Dashboard::master')
@section('title' , __('User::translation.user.create'))
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('panel.users.index') }}"> @lang('User::translation.user.index') </a></li>
    <li class="breadcrumb-item active"><a > @lang('User::translation.user.create')</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card overflow-hidden border border-5">
                <div class="card-header border border-5">
                    <div class="alert alert-primary" role="alert">
                        <div class="row">
                            <div class="col-md-6">
                                @lang('User::translation.user.create')
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('panel.users.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <label>نام </label>
                                        <input type="text" class="form-control" name="first_name"
                                               placeholder="نام"
                                               value="{{ old('first_name') }}">
                                        <x-validation-error field="first_name"/>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label> نام خانوادگی</label>
                                        <input type="text" class="form-control" name="last_name"
                                               placeholder=" نام خانوادگی"
                                               value="{{ old('last_name') }}">
                                        <x-validation-error field="last_name"/>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label>ایمیل</label>
                                        <input type="text" class="form-control" name="email"
                                               placeholder="ایمیل"
                                               value="{{ old('email') }}">
                                        <x-validation-error field="email"/>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label>موبایل</label>
                                        <input type="text" class="form-control" name="mobile"
                                               placeholder="موبایل"
                                               value="{{ old('mobile' ) }}">
                                        <x-validation-error field="mobile"/>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label>رمز عبور جدید</label>
                                        <input type="password" class="form-control" name="password"
                                               placeholder="رمز عبور جدید">
                                        <x-validation-error field="password"/>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label>عکس پروفایل</label>
                                        <input type="file" class="form-control" name="profile"
                                               placeholder="عکس پروفایل">
                                        <x-validation-error field="profile"/>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label>وضعیت</label>
                                        <select class="form-control" name="status">
                                            <option value>  یک وضعیت را انتخاب کنید</option>
                                            @foreach(\Modules\User\Models\User::$statuses as  $statusName => $status)
                                                <option value="{{ $status }}"
                                                        @selected(old('status') == $status)
                                                > {{ $statusName }} </option>
                                            @endforeach
                                        </select>
                                        <x-validation-error field="status"/>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label>وضعیت ایمیل</label>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <input type="checkbox" class="form-check mt-2" value="1" name="verify_email"
                                                       placeholder="تایید ایمیل">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <hr>
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col-md-9">
                                        <button type="submit" class="btn btn-primary btn-uppercase">
                                            <i class="ti-check-box m-l-5"></i>بروزرسانی
                                        </button>
                                        <a href="{{ route('panel.users.index') }}" class="btn btn-secondary waves-effect">
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
