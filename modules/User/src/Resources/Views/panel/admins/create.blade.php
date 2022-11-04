@extends('Dashboard::master')
@section('title' , __('User::translation.admin.create'))
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('panel.admins.index') }}"> @lang('User::translation.admin.index') </a>
    </li>
    <li class="breadcrumb-item active"><a> @lang('User::translation.admin.create')</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card overflow-hidden border border-5">
                <div class="card-header border border-5">
                    <div class="alert alert-primary" role="alert">
                        <div class="row">
                            <div class="col-md-6">
                                @lang('User::translation.admin.create')
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('panel.admins.store') }}" enctype="multipart/form-data">
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
                                        <label>کد ملی </label>
                                        <input type="text" class="form-control" name="national_code"
                                               placeholder="کد ملی"
                                               value="{{ old('national_code') }}">
                                        <x-validation-error field="national_code"/>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label>نام کاریری</label>
                                        <input type="text" class="form-control" name="username"
                                               placeholder="نام کاریری"
                                               value="{{ old('username') }}">
                                        <x-validation-error field="username"/>
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
                                            <option value> یک وضعیت را انتخاب کنید</option>
                                            @foreach(\Modules\User\Models\User::$statuses as  $statusName => $status)
                                                <option value="{{ $status }}"
                                                    @selected(old('status') == $status)
                                                > {{ $statusName }} </option>
                                            @endforeach
                                        </select>
                                        <x-validation-error field="status"/>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <div class="row">
                                            <div class="col-sm-9">
                                                <label class="col-form-label"> نقش کاربری</label>
                                                <div class="form-group">
                                                    <select name="role_ids[]" class="select2-multiple form-control"
                                                            multiple dir="rtl" id="select-role-id">
                                                        @foreach($roles as  $role)
                                                            <option
                                                                value="{{ $role->id  }}"
                                                                @if(is_array( old('role_ids')) && in_array($role->id ,  old('role_ids') )) selected @endif
                                                            >  {{ $role->name }} </option>

                                                        @endforeach
                                                    </select>
                                                </div>
                                                <x-validation-error field="role_ids"/>
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
                                        <a href="{{ route('panel.admins.index') }}"
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
        @section('css')
            <link rel="stylesheet" href="/assets/panel/vendors/select2/css/select2.min.css" type="text/css">
        @endsection

        @section('script')
            <script src="/assets/panel/vendors/select2/js/select2.min.js"></script>
            <script>
                $('#select-role-id').select2({
                    placeholder: " نقش کاربری را انتخاب کنید",
                    // allowClear: true
                });
            </script>
@endsection
