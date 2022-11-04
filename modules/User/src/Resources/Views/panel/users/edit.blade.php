@extends('Dashboard::master')
@section('title' , __('User::translation.user.edit'))
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('panel.users.index') }}"> @lang('User::translation.user.index') </a></li>
    <li class="breadcrumb-item active"><a > @lang('User::translation.user.edit')</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card overflow-hidden border border-5">
                <div class="card-header border border-5">
                    <div class="alert alert-primary" role="alert">
                        <div class="row">
                            <div class="col-md-6">
                                @lang('User::translation.user.edit') "{{ $user->username ?? $user->email }}"
                            </div>
                            <div class="col-md-6">
                                <div class="font-size-12 text-left">  تاریخ اخرین بروزرسانی : {{ getJalaliDate($user->updated_at) }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('panel.users.update' , $user->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <div class="row">

                                    <div class="col-md-3 mb-3">
                                        <label>نام </label>
                                        <input type="text" class="form-control" name="first_name"
                                               placeholder="نام"
                                               value="{{ old('first_name' , $user->first_name) }}">
                                        <x-validation-error field="first_name"/>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label> نام خانوادگی</label>
                                        <input type="text" class="form-control" name="last_name"
                                               placeholder=" نام خانوادگی"
                                               value="{{ old('last_name' , $user->last_name) }}">
                                        <x-validation-error field="last_name"/>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label>ایمیل</label>
                                        <input type="text" class="form-control" name="email"
                                               placeholder="ایمیل"
                                               value="{{ old('email' , $user->email) }}">
                                        <x-validation-error field="email"/>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label>موبایل</label>
                                        <input type="text" class="form-control" name="mobile"
                                               placeholder="موبایل"
                                               value="{{ old('mobile' , $user->mobile) }}">
                                        <x-validation-error field="mobile"/>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label>رمز عبور جدید</label>
                                        <input type="text" class="form-control" name="password"
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
                                                    @selected($status == $user->status)
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
                                                       @checked($user->hasVerifiedEmail())
                                                       placeholder="تایید ایمیل">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div>
                                    <p>  عکس پروفایل فعلی : </p>
                                    @if(!is_null($user->profile))
                                        <a href="{{ route('panel.users.profile.show' , $user->profile) }}">
                                            <img width="250px" src="{{ route('panel.users.profile.show' , [$user->profile]) }}" alt="">
                                        </a>
                                    @else
                                        این کاربر عکسی برای پروفایل خود قرار نداده است.
                                    @endif
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
