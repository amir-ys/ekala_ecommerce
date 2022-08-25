@extends('Dashboard::master')
@section('title'  ,__('Product::translation.color.index') . ' ' . $product->name)
@section('breadcrumb')
    <li class="breadcrumb-item active"><a>@lang('Product::translation.color.index')</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="row mb-3">
                <div class="col-sm-12 col-md-12 col-lg-2">
                    <a href="{{ route('panel.products.colors.create' , $product->id) }}"
                       class="btn btn-primary
                        btn-rounded waves-effect waves-light mb-2 me-2">
                        <i class="mdi mdi-plus me-1"></i>
                        @lang('Product::translation.color.create')</a>
                </div>
            </div>
            <div class="card">
                <div class="card-body border border-5">
                    <div class="table-responsive">
                        <table id="table" class="table table-hover">
                            <thead class="thead-light">
                            <tr>
                                <th>شناسه</th>
                                <th>نام</th>
                                <th>مقدار</th>
                                <th>افزابش قیمت</th>
                                <th>تاریخ ایجاد</th>
                                <th> عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($colors as $color)
                                <tr>
                                    <td>{{ $loop->iteration  }}</td>
                                    <td>{{ $color->color_name }}</td>
                                    <td>{{ $color->color_value }}</td>
                                    <td>{{  number_format($color->price_increase) }} تومان</td>
                                    <td>{{ getJalaliDate($color->created_at) }}</td>
                                    <td>
                                        <a class="btn btn-sm bg-transparent d-inline"
                                           href="{{ route('panel.products.colors.edit' , [$product->id ,  $color->id]) }}"><i
                                                class="fa fa-pencil fa-15m text-success"></i></a>

                                        <a href="{{ route('panel.products.colors.destroy' , [$product->id , $color->id]) }}"
                                           onclick="deleteItem(event ,  '{{ route('panel.products.colors.destroy' , [$product->id ,  $color->id]) }}')"
                                           class="btn btn-sm bg-transparent d-inline delete-confirm"><i
                                                class="fa fa-trash fa-15m text-danger"></i></a>

                                        <form
                                            action="{{ route('panel.products.colors.destroy' , [ $product->id ,  $color->id]) }}"
                                            method="post"
                                            id="destroy-brand-{{ $color->id }}">
                                            @csrf
                                            @method('delete')
                                        </form>
                                    </td>
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
