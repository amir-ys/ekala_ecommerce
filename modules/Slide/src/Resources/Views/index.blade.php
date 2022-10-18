@extends('Dashboard::master')
@section('title'  ,__('Slide::translation.index'))
@section('breadcrumb')
    <li class="breadcrumb-item active"><a>@lang('Slide::translation.index')</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="row mb-3">
                <div class="col-sm-12 col-md-12 col-lg-2">
                    <a href="{{ route('panel.slides.create') }}"
                       class="btn btn-primary
                        btn-rounded waves-effect waves-light mb-2 me-2">
                        <i class="mdi mdi-plus me-1"></i>
                        @lang('Slide::translation.create')
                    </a>
                </div>
            </div>
            <div class="card">
                <div class="card-body border border-5">
                    <div class="table-responsive">
                        <table  id="table" class="table table-hover">
                            <thead class="thead-light">
                            <tr>
                                <th>شناسه</th>
                                <th>موضوع</th>
                                <th>اولویت</th>
                                <th>لینک </th>
                                <th>نوع</th>
                                <th>وضعیت</th>
                                <th>عکس</th>
                                <th> تاریخ ایجاد</th>
                                <th> عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($slides as $slide)
                                <tr>
                                    <td>{{ $loop->iteration  }}</td>
                                    <td>{{ $slide->title }}</td>
                                    <td>{{ $slide->priority ?: '-'  }}</td>
                                    <td><a href="{{$slide->link}}">{{ $slide->link  }}</a></td>
                                    <td>
                                        <span
                                            class="badge py-1 bg-light"> @lang($slide->type->name) </span>
                                    </td>

                                    <td>
                                        <span
                                            class="badge py-1 bg-{{ $slide->statusCssClass }}"> @lang($slide->status->name) </span>
                                    </td>

                                    <td>
                                        <a href="{{ route('panel.slides.image' , $slide->id) }}">
                                            <img width="100px" src="{{ route('panel.slides.image' , [$slide->id]) }}" alt="">
                                        </a>
                                    </td>

                                    <td>{{ getJalaliDate($slide->created_at) }}</td>
                                    <td>
                                        <a class="btn btn-sm bg-transparent d-inline"
                                           href="{{ route('panel.slides.edit' , $slide->id) }}"><i
                                                class="fa fa-pencil fa-15m text-success"></i></a>

                                        <a href="{{ route('panel.slides.destroy' , $slide->id) }}"
                                           onclick="deleteItem(event ,  '{{ route('panel.slides.destroy' , $slide->id) }}')"
                                           class="btn btn-sm bg-transparent d-inline delete-confirm"><i
                                                class="fa fa-trash fa-15m text-danger"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </div>
    <!-- /basic responsive table -->
@endsection
