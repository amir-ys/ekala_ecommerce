@extends('Dashboard::master')
@section('title'  ,__('User::translation.index'))
@section('breadcrumb')
    <li class="breadcrumb-item active"><a>@lang('User::translation.index')</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body border border-5">
                    <div class="table-responsive">
                        <table id="table" class="table table-hover">
                            <thead class="thead-light">
                            <tr>
                                <th>شناسه</th>
                                <th> عکس پروفایل </th>
                                <th> نام کاربری </th>
                                <th> نام و نام خانوادگی </th>
                                <th> ایمیل </th>
                                <th> موبایل</th>
                                <th> وضعیت تایید ایمیل </th>
                                <th> وضعیت کاربر </th>
                                <th> عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration  }}</td>
                                    <td>
                                        @if(!is_null($user->profile))
                                            <a href="{{ route('panel.users.profile.show' , $user->profile) }}">
                                                <img width="100px" src="{{ route('panel.users.profile.show' , [$user->profile]) }}" alt="">
                                            </a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{ $user->username ?? '-' }}</td>
                                    <td>{{ $user->full_name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->mobile ?? '-' }}</td>
                                    <td>
                                        <span class="badge badge-{{ $user->hasVerifiedEmail() ? 'success'  : 'danger' }}">
                                            {{ $user->hasVerifiedEmail() ? 'تایید شده'  : 'تایید نشذه' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge badge-{{ $user->statusCss }}">
                                            {{ $user->statusName }}
                                        </span>
                                    </td>
                                    <td>
                                        <a class="btn btn-sm bg-transparent d-inline"
                                           href="{{ route('panel.users.edit' , $user->id) }}"><i
                                                class="fa fa-pencil fa-15m text-success"></i></a>
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
