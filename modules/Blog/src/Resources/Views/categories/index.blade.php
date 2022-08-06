@extends('Dashboard::master')
@section('title'  ,__('Blog::translation.category.index'))
@section('breadcrumb')
    <li class="breadcrumb-item active"><a>@lang('Blog::translation.category.index')</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="row mb-3">
                <div class="col-sm-12 col-md-12 col-lg-2">
                    <a href="{{ route('panel.blog.categories.create') }}"
                       class="btn btn-primary
                        btn-rounded waves-effect waves-light mb-2 me-2">
                        <i class="mdi mdi-plus me-1"></i>
                        @lang('Blog::translation.category.create')</a>
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
                                <th>عکس</th>
                                <th> تاریخ ایجاد</th>
                                <th>تگ ها</th>
                                <th>وضعیت</th>
                                <th> عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $loop->iteration  }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        <a href="{{ route('panel.blog.categories.showImage' , $category->image) }}">
                                            <img width="100px" src="{{ route('panel.blog.categories.showImage' , [$category->image]) }}" alt="">
                                        </a>
                                    </td>
                                    <td>{{ getJalaliDate($category->created_at) }}</td>
                                    <td>
                                        {{ is_array($category->tags) ?
                                                        implode( ' , ' , $category->tags ) :  '-'  }}
                                    </td>
                                    <td>
                                        <span
                                            class="badge py-1 bg-{{ $category->statusCssClass }}"> {{ $category->status_name }}
                                        </span>
                                    </td>

                                    <td>
                                        <a class="btn btn-sm bg-transparent d-inline"
                                           href="{{ route('panel.blog.categories.edit' , $category->id) }}"><i
                                                class="fa fa-pencil fa-15m text-success"></i></a>

                                        <a href="{{ route('panel.blog.categories.destroy' , $category->id) }}"
                                           onclick="deleteItem(event ,  '{{ route('panel.blog.categories.destroy' , $category->id) }}')"
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
    </div>
    <!-- /basic responsive table -->
@endsection