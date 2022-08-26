@extends('Dashboard::master')
@section('title'  ,__('Coupon::translation.commonDiscount.index'))
@section('breadcrumb')
    <li class="breadcrumb-item active"><a>@lang('Coupon::translation.commonDiscount.index')</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="row mb-3">
                <div class="col-sm-12 col-md-12 col-lg-2">
                    <a href="{{ route('panel.commonDiscounts.create') }}"
                       class="btn btn-primary
                        btn-rounded waves-effect waves-light mb-2 me-2">
                        <i class="mdi mdi-plus me-1"></i>
                        @lang('Coupon::translation.commonDiscount.create')</a>
                </div>
            </div>
            <div class="card">
                <div class="card-body border border-5">
                    <div class="table-responsive">
                        <table id="table" class="table table-hover">
                            <thead class="thead-light">
                            <tr>
                                <th>شناسه</th>
                                <th>موضوع</th>
                                <th> درصد</th>
                                <th>حداکثر تخفیف مبلفی</th>
                                <th> کمتربن مقدار سفارش</th>
                                <th>تاریخ شروع</th>
                                <th>تاریخ پایان</th>
                                <th> وضعیت</th>
                                <th> عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($discounts as $discount)
                                <tr>
                                    <td>{{ $loop->iteration  }}</td>
                                    <td>{{ $discount->title }}</td>
                                    <td> {{ $discount->percent }} </td>
                                    <td> {{  $discount->discount_ceiling }} </td>
                                    <td>{{ $discount->minimal_order_amount }}</td>
                                    <td>{{ getJalaliFromFormat($discount->start_date , null , 'H:i Y-m-d') }}</td>
                                    <td>{{ getJalaliFromFormat($discount->end_date , null , 'H:i Y-m-d') }}</td>
                                    <td>
                                        <span class="badge py-1 bg-{{ $discount->statusCssClass }}"> {{ $discount->status_name }}
                                        </span>
                                    </td>
                                    <td>
                                        <a class="btn btn-sm bg-transparent d-inline"
                                           href="{{ route('panel.commonDiscounts.edit' , $discount->id) }}"><i
                                                class="fa fa-pencil fa-15m text-success"></i></a>

                                        <a href="{{ route('panel.commonDiscounts.destroy' , $discount->id) }}"
                                           onclick="deleteItem(event ,  '{{ route('panel.commonDiscounts.destroy' , $discount->id) }}')"
                                           class="btn btn-sm bg-transparent d-inline delete-confirm"><i
                                                class="fa fa-trash fa-15m text-danger"></i></a>

                                        <form action="{{ route('panel.commonDiscounts.destroy' , $discount->id) }}"
                                              method="post"
                                              id="destroy-brand-{{ $discount->id }}">
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
