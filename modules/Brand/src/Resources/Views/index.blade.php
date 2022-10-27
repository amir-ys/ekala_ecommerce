@extends('Dashboard::master')
@section('title'  ,    __('Brand::translation.index'))
@section('breadcrumb')
    <li class="breadcrumb-item active"><a> @lang('Brand::translation.index') </a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body border border-5">
                    <div class="row mb-3">
                    </div>
                    <div class="table-responsive">
                        <table id="table" class="table table-hover">
                            <thead class="thead-light">
                            <tr>
                                <th>شناسه</th>
                                <th>نام</th>
                                <th> تاریخ ایجاد</th>
                                <th>وضعیت</th>
                                @can(\Modules\RolePermissions\Models\Permission::PERMISSION_MANAGE_BRANDS)
                                <th> عملیات</th>
                                @endcan
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($brands as $brand)
                                <tr>
                                    <td>{{ $loop->iteration  }}</td>
                                    <td>{{ $brand->name }}</td>
                                    <td>{{ getJalaliDate($brand->created_at) }}</td>
                                    <td>
                                        <span
                                        class="badge py-1 bg-{{ $brand->statusCssClass }}"> @lang($brand->is_active->name) </span>
                                    </td>
                                    @can(\Modules\RolePermissions\Models\Permission::PERMISSION_MANAGE_BRANDS)
                                    <td>
                                        <a class="btn btn-sm bg-transparent d-inline"
                                           href="{{ route('panel.brands.edit' , $brand) }}"><i
                                                class="fa fa-pencil fa-15m text-success"></i></a>

                                        <a href="{{ route('panel.brands.destroy' , $brand->id) }}"
                                           onclick="deleteItem(event ,  '{{ route('panel.brands.destroy' , $brand->id) }}')"
                                           class="btn btn-sm bg-transparent d-inline delete-confirm"><i
                                                class="fa fa-trash fa-15m text-danger"></i></a>

                                        <form action="{{ route('panel.brands.destroy' , $brand->id) }}" method="post"
                                        id="destroy-brand-{{ $brand->id }}">
                                            @csrf
                                            @method('delete')
                                        </form>
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
        @can(\Modules\RolePermissions\Models\Permission::PERMISSION_MANAGE_BRANDS)
        @include('Brand::create')
        @endcan
    </div>
    <!-- /basic responsive table -->
@endsection
