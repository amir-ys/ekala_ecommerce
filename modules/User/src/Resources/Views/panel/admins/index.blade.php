@extends('Dashboard::master')
@section('title'  ,__('User::translation.admin.index'))
@section('breadcrumb')
    <li class="breadcrumb-item active"><a>@lang('User::translation.admin.index')</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            @can(\Modules\RolePermissions\Models\Permission::PERMISSION_MANAGE_USERS)
                <div class="row mb-3">
                    <div class="col-sm-12 col-md-12 col-lg-2">
                        <a href="{{ route('panel.admins.create') }}"
                           class="btn btn-primary
                        btn-rounded waves-effect waves-light mb-2 me-2">
                            <i class="mdi mdi-plus me-1"></i>
                            @lang('User::translation.admin.create')</a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-body border border-5">
                    <div class="table-responsive">
                        <table id="table" class="table table-hover">
                            <thead class="thead-light">
                            <tr>
                                <th>شناسه</th>
                                <th> عکس پروفایل</th>
                                <th> نام و نام خانوادگی</th>
                                <th>  کد ملی</th>
                                <th> نام کاربری</th>
                                <th> ایمیل</th>
                                <th> موبایل</th>
                                <th> وضعیت کاربر</th>
                                @can(\Modules\RolePermissions\Models\Permission::PERMISSION_MANAGE_USERS)
                                    <th> عملیات</th>
                                @endcan
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($admins as $admin)
                                <tr>
                                    <td>{{ $loop->iteration  }}</td>
                                    <td>
                                        @if(!is_null($admin->profile))
                                            <a href="{{ route('panel.admins.profile.show' , $admin->profile) }}">
                                                <img width="50px" height="50px"
                                                     src="{{ route('panel.admins.profile.show' , [$admin->profile]) }}"
                                                     alt="">
                                            </a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{ $admin->full_name }}</td>
                                    <td>{{ $admin->national_code }}</td>
                                    <td>{{ $admin->username ?? '-' }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td>{{ $admin->mobile ?? '-' }}</td>
                                    <td>
                                        <span class="badge badge-{{ $admin->statusCss }}">
                                            {{ $admin->statusName }}
                                        </span>
                                    </td>
                                    @can(\Modules\RolePermissions\Models\Permission::PERMISSION_MANAGE_USERS)
                                        <td>
                                            <a class="btn btn-sm bg-transparent d-inline"
                                               href="{{ route('panel.admins.edit' , $admin->id) }}"><i
                                                    class="fa fa-pencil fa-15m text-success"></i></a>

                                            <a class="btn btn-sm bg-transparent d-inline"
                                               onclick="deleteItem(event , '{{ route('panel.admins.destroy' , $admin->id) }}' )"
                                               href="{{ route('panel.admins.destroy' , $admin->id) }}"><i
                                                    class="fa fa-trash fa-15m text-danger"></i></a>
                                        </td>
                                    @endcan
                                </tr>
                            @endforeach
                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /basic responsive table -->
@endsection

