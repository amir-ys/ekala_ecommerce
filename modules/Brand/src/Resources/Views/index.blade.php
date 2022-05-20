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
                        <table id="tbl_users" class="table table-hover">
                            <thead class="thead-light">
                            <tr>
                                <th>شناسه</th>
                                <th>نام</th>
                                <th> تاریخ ایجاد</th>
                                <th>وضعیت</th>
                                <th> عملیات</th>
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
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! $brands->links() !!}
                    </div>
                </div>
            </div>
        </div>
        @include('Brand::create')
    </div>
    <!-- /basic responsive table -->
@endsection