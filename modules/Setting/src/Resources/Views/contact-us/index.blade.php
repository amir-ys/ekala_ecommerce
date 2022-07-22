@extends('Dashboard::master')
@section('title'  ,__('Setting::translation.contact.index'))
@section('breadcrumb')
    <li class="breadcrumb-item active"><a href="{{ route('panel.settings.index') }}">@lang('Setting::translation.index')</a></li>
    <li class="breadcrumb-item active"><a>@lang('Setting::translation.contact.index')</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="row mb-3">
                <div class="col-sm-12 col-md-12 col-lg-2">
                    <a href="{{ route('panel.settings.contact.save') }}"
                       class="btn btn-primary
                        btn-rounded waves-effect waves-light mb-2 me-2">
                        <i class="mdi mdi-plus me-1"></i>
                        @lang('Setting::translation.contact.save')</a>
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
                                <th> ایمیل </th>
                                <th>  شماره تماس </th>
                                <th> موضوع </th>
                                <th> پیام </th>
                                <th>وضعیت</th>
                                <th> عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($settings as $setting)
                                <tr>
                                    <td>{{ $loop->iteration  }}</td>
                                    <td>{{ $setting->name  }}</td>
                                    <td>{{ $setting->email  }}</td>
                                    <td>{{ $setting->phone_number  }}</td>
                                    <td>{{ $setting->subject  }}</td>
                                    <td>{{ $setting->message  }}</td>
                                    <td>{{ $setting->status  }}</td>
                                    <td>
                                        <a class="btn btn-sm bg-transparent d-inline"
                                           href="{{ route('panel.settings.contact.show' , $setting->id) }}"><i
                                                class="fa fa-eye fa-15m text-primary"></i></a>
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
