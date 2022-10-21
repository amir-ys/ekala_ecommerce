@extends('Dashboard::master')
@section('title' , __('RolePermissions::translation.role.create'))
@section('breadcrumb')
    <li class="breadcrumb-item"><a
            href="{{ route('panel.roles.index') }}"> @lang('RolePermissions::translation.role.index') </a></li>
    <li class="breadcrumb-item active"><a> @lang('RolePermissions::translation.role.create')</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="col-xl-12">
                <div class="card overflow-hidden border border-5">
                    <div class="card-header border border-5">
                        <div class="alert alert-primary" role="alert">
                            @lang('RolePermissions::translation.role.create')
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('panel.roles.store') }}"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="col-md-12">
                                    <label for="name" class="col-form-label">نام</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="name" name="name"
                                               placeholder="نام"
                                               value="{{ old('name') }}">
                                        <x-validation-error field="name"/>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="card border border-2">
                                        <div class="card-header">
                                            <div class="title"> مجوزها</div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                @foreach($permissions  as $permission)
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input"
                                                                       name="permissions[{{ $permission->id }}]"
                                                                       id="{{ $permission->id }}"
                                                                       value="{{ $permission->id }}"
                                                                    @checked(is_array(old('permissions')) && in_array($permission->id , old('permissions')))
                                                                >
                                                                <label class="custom-control-label"
                                                                       for="{{ $permission->id }}">{{ $permission->name }}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <x-validation-error field="permissions"/>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-uppercase">
                                        <i class="ti-check-box m-l-5"></i>ذخیره
                                    </button>
                                    <a href="{{ route('panel.roles.index') }}"
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
