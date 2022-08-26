@extends('Dashboard::master')
@section('title'  ,__('Coupon::translation.index'))
@section('breadcrumb')
    <li class="breadcrumb-item active"><a>@lang('Coupon::translation.index')</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="row mb-3">
                <div class="col-sm-12 col-md-12 col-lg-2">
                    <a href="{{ route('panel.coupons.create') }}"
                       class="btn btn-primary
                        btn-rounded waves-effect waves-light mb-2 me-2">
                        <i class="mdi mdi-plus me-1"></i>
                        @lang('Coupon::translation.create')</a>
                </div>
            </div>
            <div class="card">
                <div class="card-body border border-5">
                    <div class="table-responsive">
                        <table id="table" class="table table-hover">
                            <thead class="thead-light">
                            <tr>
                                <th>شناسه</th>
                                <th>کد</th>
                                <th> نوع</th>
                                <th> مقدار</th>
                                <th> درصد</th>
                                <th>تاریخ اعتبار</th>
                                <th>تاریخ ساخت</th>
                                <th> عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($coupons as $coupon)
                                <tr>
                                    <td>{{ $loop->iteration  }}</td>
                                    <td>{{ $coupon->code }}</td>
                                    <td> @lang($coupon->type) </td>
                                    <td> {{  $coupon->amount ? 'تومان' . $coupon->amount : '-' }} </td>
                                    <td> {{  $coupon->percent ? '%' . $coupon->percent : '-' }} </td>
                                    <td>{{ $coupon->expired_at }}</td>
                                    <td>{{ getJalaliDate($coupon->created_at) }}</td>
                                    <td>
                                        <a class="btn btn-sm bg-transparent d-inline"
                                           href="{{ route('panel.coupons.edit' , $coupon->id) }}"><i
                                                class="fa fa-pencil fa-15m text-success"></i></a>

                                        <a href="{{ route('panel.coupons.destroy' , $coupon->id) }}"
                                           onclick="deleteItem(event ,  '{{ route('panel.coupons.destroy' , $coupon->id) }}')"
                                           class="btn btn-sm bg-transparent d-inline delete-confirm"><i
                                                class="fa fa-trash fa-15m text-danger"></i></a>

                                        <form action="{{ route('panel.coupons.destroy' , $coupon->id) }}" method="post"
                                              id="destroy-brand-{{ $coupon->id }}">
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
