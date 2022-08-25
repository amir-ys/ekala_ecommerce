@extends('Dashboard::master')
@section('title'  ,__('Product::translation.delivery.index'))
@section('breadcrumb')
    <li class="breadcrumb-item active"><a>@lang('Product::translation.delivery.index')</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="row mb-3">
                <div class="col-sm-12 col-md-12 col-lg-2">
                    <a href="{{ route('panel.delivery.create') }}"
                       class="btn btn-primary
                        btn-rounded waves-effect waves-light mb-2 me-2">
                        <i class="mdi mdi-plus me-1"></i>
                        @lang('Product::translation.delivery.create')</a>
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
                                <th> مدت زمان ارسال</th>
                                <th>تاریخ ایجاد</th>
                                <th>وضعیت</th>
                                <th> عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($delivery_methods as $delivery)
                                <tr>
                                    <td>{{ $loop->iteration  }}</td>
                                    <td>{{ $delivery->name }}</td>
                                    <td>{{  number_format($delivery->amount) }} تومان</td>
                                    <td>{{ $delivery->delivery_time  }} {{   $delivery->delivery_unit }}</td>
                                    <td>{{ getJalaliDate($delivery->created_at) }}</td>
                                    <td>
                                        <span class="badge py-1 bg-{{ $delivery->status_css }}">
                                            {{ $delivery->status_name }}
                                        </span>
                                    </td>

                                    <td>
                                        <a class="btn btn-sm bg-transparent d-inline"
                                           href="{{ route('panel.delivery.edit' , $delivery->id) }}"><i
                                                class="fa fa-pencil fa-15m text-success"></i></a>

                                        <a href="{{ route('panel.delivery.destroy' , $delivery->id) }}"
                                           onclick="deleteItem(event ,  '{{ route('panel.delivery.destroy' , $delivery->id) }}')"
                                           class="btn btn-sm bg-transparent d-inline delete-confirm"><i
                                                class="fa fa-trash fa-15m text-danger"></i></a>

                                        <form action="{{ route('panel.delivery.destroy' , $delivery->id) }}"
                                              method="post"
                                              id="destroy-brand-{{ $delivery->id }}">
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
