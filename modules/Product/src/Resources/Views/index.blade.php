@extends('Dashboard::master')
@section('title'  ,__('Product::translation.index'))
@section('breadcrumb')
    <li class="breadcrumb-item active"><a>@lang('Product::translation.index')</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="row mb-3">
                <div class="col-sm-12 col-md-12 col-lg-2">
                    <a href="{{ route('panel.products.create') }}"
                       class="btn btn-primary
                        btn-rounded waves-effect waves-light mb-2 me-2">
                        <i class="mdi mdi-plus me-1"></i>
                        @lang('Product::translation.create')</a>
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
                                <th> دسته بندی</th>
                                <th>  برند</th>
                                <th> قیمت</th>
                                <th> قیمت با تخفیف</th>
                                <th> تاریخ ایجاد</th>
                                <th> قابل فروش بودن </th>
                                <th> وضعیت</th>
                                <th> عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $loop->iteration  }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{  $product->category->name  }}</td>
                                    <td>{{  $product->brand->name  }}</td>
                                    <td>{{ number_format( $product->price)  }}</td>
                                    <td>{{ ( $product->hasDiscount ? number_format( $product->finalPrice()) : '-')  }}</td>
                                    <td>{{ getJalaliDate($product->created_at) }}</td>
                                    <td>
                                        <span
                                            class="badge py-1 bg-{{ $product->marketableCssClass }}">  {{  $product->marketable_name }}
                                        </span>
                                    </td>

                                    <td>
                                        <span
                                            class="badge py-1 bg-{{ $product->statusCssClass }}"> @lang($product->is_active->name)
                                        </span>
                                    </td>

                                    <td>
                                        <div class="row">
                                            <a class="btn btn-sm bg-transparent d-inline"
                                               href="{{ route('panel.products.edit' , $product->id) }}"><i
                                                    class="fa fa-pencil fa-15m text-success"></i></a>

                                            <a href="{{ route('panel.products.destroy' , $product->id) }}"
                                               onclick="deleteItem(event ,  '{{ route('panel.products.destroy' , $product->id) }}')"
                                               class="btn btn-sm bg-transparent d-inline delete-confirm"><i
                                                    class="fa fa-trash fa-15m text-danger"></i></a>

                                            <div class="dropdown">
                                                <button class="btn btn-primary btn-sm dropdown-toggle" type="button"
                                                        data-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-gear"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right"
                                                     aria-labelledby="dropdownMenuButton" x-placement="bottom-end"
                                                     style="position: absolute; transform: translate3d(9px, 36px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                    <ul>
                                                        <li class="mr-md-3">
                                                            <a href="{{ route('panel.products.colors.index' , $product->id) }}">
                                                                مدیریت رنگ ها </a>
                                                        </li>
                                                        <li class="mr-md-3">
                                                            <a href="{{ route('panel.products.warranties.index' , $product->id) }}">مدیریت
                                                                گارانتی </a>
                                                        </li>
                                                        <li class="mr-md-3">
                                                            <a href="{{ route('panel.products.images.show' , $product->id) }}">
                                                                گالری </a>
                                                        </li>
                                                        <li class="mr-md-3">
                                                            <a href="{{ route('panel.products.attributes.show' , $product->id) }}">
                                                                افزودن ویژگی </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>

                                        </div>
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
