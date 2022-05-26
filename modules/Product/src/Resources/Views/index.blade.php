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
                                <th> دسته بندی </th>
                                <th> برند </th>
                                <th> قیمت </th>
                                <th> موجودی </th>
                                <th> تاریخ ایجاد</th>
                                <th> وضعیت </th>
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
                                    <td>{{ $product->quantity  }}</td>
                                    <td>{{ getJalaliDate($product->created_at) }}</td>
                                    <td>
                                        <span
                                            class="badge py-1 bg-{{ $product->statusCssClass }}"> @lang($product->is_active->name)
                                        </span>
                                    </td>

                                    <td>
                                        <a class="btn btn-sm bg-transparent d-inline"
                                           href="{{ route('panel.products.edit' , $product->id) }}"><i
                                                class="fa fa-pencil fa-15m text-success"></i></a>

                                        <a href="{{ route('panel.products.destroy' , $product->id) }}"
                                           onclick="deleteItem(event ,  '{{ route('panel.products.destroy' , $product->id) }}')"
                                           class="btn btn-sm bg-transparent d-inline delete-confirm"><i
                                                class="fa fa-trash fa-15m text-danger"></i></a>

                                        <form action="{{ route('panel.products.destroy' , $product->id) }}" method="post"
                                              id="destroy-brand-{{ $product->id }}">
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
