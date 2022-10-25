@extends('Dashboard::master')
@section('title'  ,__('RolePermissions::translation.role.index'))
@section('breadcrumb')
    <li class="breadcrumb-item active"><a>@lang('RolePermissions::translation.role.index')</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            @if(auth()->user()->hasPermissionTo(\Modules\RolePermissions\Models\Permission::PERMISSION_MANAGE_ROLE_PERMISSIONS))
                <div class="row mb-3">
                    <div class="col-sm-12 col-md-12 col-lg-2">
                        <a href="{{ route('panel.roles.create') }}"
                           class="btn btn-primary
                        btn-rounded waves-effect waves-light mb-2 me-2">
                            <i class="mdi mdi-plus me-1"></i>
                            @lang('RolePermissions::translation.role.create')</a>
                    </div>
                </div>
            @endif
            <div class="card">
                <div class="card-body border border-5">
                    <div class="table-responsive">
                        <table id="table" class="table table-hover">
                            <thead class="thead-light">
                            <tr>
                                <th>شناسه</th>
                                <th>نام</th>
                                <th> مجوز ها</th>
                                <th> تاریخ ایجاد</th>
                                @if(auth()->user()->hasPermissionTo(\Modules\RolePermissions\Models\Permission::PERMISSION_MANAGE_ROLE_PERMISSIONS))
                                <th> عملیات</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $role)
                                <tr>
                                    <td>{{ $loop->iteration  }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        <span>
                                            <ul>
                                                @foreach($role->permissions as $permission)
                                                    <li> @lang($permission->name) </li>
                                                @endforeach
                                            </ul>
                                        </span>
                                    </td>
                                    <td>{{ getJalaliDate($role->created_at) }}</td>
                                    @if(auth()->user()->hasPermissionTo(\Modules\RolePermissions\Models\Permission::PERMISSION_MANAGE_ROLE_PERMISSIONS))
                                    <td>
                                        <a class="btn btn-sm bg-transparent d-inline"
                                           href="{{ route('panel.roles.edit' , $role->id) }}"><i
                                                class="fa fa-pencil fa-15m text-success"></i></a>

                                        <a href="{{ route('panel.roles.destroy' , $role->id) }}"
                                           onclick="deleteItem(event ,  '{{ route('panel.roles.destroy' , $role->id) }}')"
                                           class="btn btn-sm bg-transparent d-inline delete-confirm"><i
                                                class="fa fa-trash fa-15m text-danger"></i></a>

                                    </td>
                                    @endif
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
