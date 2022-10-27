@extends('Dashboard::master')
@section('title'  ,__('Product::translation.warranty.index') . ' ' . $product->name)
@section('breadcrumb')
    <li class="breadcrumb-item active"><a>@lang('Product::translation.warranty.index')</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="row mb-3">
                @can(\Modules\RolePermissions\Models\Permission::PERMISSION_MANAGE_PRODUCTS)
                    <div class="col-sm-12 col-md-12 col-lg-2">
                        <a href="{{ route('panel.products.warranties.create' , $product->id) }}"
                           class="btn btn-primary
                        btn-rounded waves-effect waves-light mb-2 me-2">
                            <i class="mdi mdi-plus me-1"></i>
                            @lang('Product::translation.warranty.create')</a>
                    </div>
                @endcan
            </div>
            <div class="card">
                <div class="card-body border border-5">
                    <div class="table-responsive">
                        <table id="table" class="table table-hover">
                            <thead class="thead-light">
                            <tr>
                                <th>شناسه</th>
                                <th>نام</th>
                                <th>افزابش قیمت</th>
                                <th>تاریخ ایجاد</th>
                                @can(\Modules\RolePermissions\Models\Permission::PERMISSION_MANAGE_PRODUCTS)
                                    <th> عملیات</th>
                                @endcan
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($warranties as $warranty)
                                <tr>
                                    <td>{{ $loop->iteration  }}</td>
                                    <td>{{ $warranty->name }}</td>
                                    <td>{{  number_format($warranty->price_increase) }} تومان</td>
                                    <td>{{ getJalaliDate($warranty->created_at) }}</td>
                                    @can(\Modules\RolePermissions\Models\Permission::PERMISSION_MANAGE_PRODUCTS)
                                        <td>
                                            <a class="btn btn-sm bg-transparent d-inline"
                                               href="{{ route('panel.products.warranties.edit' , [$product->id ,  $warranty->id]) }}"><i
                                                    class="fa fa-pencil fa-15m text-success"></i></a>

                                            <a href="{{ route('panel.products.warranties.destroy' , [$product->id , $warranty->id]) }}"
                                               onclick="deleteItem(event ,  '{{ route('panel.products.warranties.destroy' , [$product->id ,  $warranty->id]) }}')"
                                               class="btn btn-sm bg-transparent d-inline delete-confirm"><i
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
