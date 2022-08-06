@extends('Dashboard::master')
@section('title'  ,__('Blog::translation.post.index'))
@section('breadcrumb')
    <li class="breadcrumb-item active"><a>@lang('Blog::translation.post.index')</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="row mb-3">
                <div class="col-sm-12 col-md-12 col-lg-2">
                    <a href="{{ route('panel.blog.posts.create') }}"
                       class="btn btn-primary
                        btn-rounded waves-effect waves-light mb-2 me-2">
                        <i class="mdi mdi-plus me-1"></i>
                        @lang('Blog::translation.post.create')</a>
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
                                <th>عکس</th>
                                <th>نویسنده</th>
                                <th>دسته بندی</th>
                                <th>قابلیت درج کامنت</th>
                                <th>زمان انتشار</th>
                                <th> تاریخ ایجاد</th>
                                <th>متن کوتاه</th>
                                <th>وضعیت</th>
                                <th> عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($posts as $post)
                                <tr>
                                    <td>{{ $loop->iteration  }}</td>
                                    <td>{{ $post->title }}</td>
                                    <td>
                                        <a href="{{ route('panel.blog.posts.showImage' , $post->image) }}">
                                            <img width="100px" src="{{ route('panel.blog.posts.showImage' , [$post->image]) }}" alt="">
                                        </a>
                                    </td>
                                    <td>{{ $post->author->username }}</td>
                                    <td>{{ $post->category->name }}</td>

                                    <td>
                                        <span class="badge py-1 bg-{{ $post->is_commentable ? 'success' : 'danger' }}">
                                            {{ $post->is_commentable ? 'دارد' : 'ندارد' }}
                                        </span>
                                    </td>

                                    <td>
                                        {{ getJalaliDate($post->published_at , 'Y-m-d H:i' , 'carbon') }}
                                    </td>
                                    <td>{{ getJalaliDate($post->created_at) }}</td>
                                    <td> {!! substr($post->summary , 0 , 20) !!}...</td>
                                    <td>
                                        <span class="badge py-1 bg-{{ $post->statusCssClass }}"> {{ $post->status_name }}
                                        </span>
                                    </td>

                                    <td>
                                        <a class="btn btn-sm bg-transparent d-inline"
                                           href="{{ route('panel.blog.posts.edit' , $post->id) }}"><i
                                                class="fa fa-pencil fa-15m text-success"></i></a>

                                        <a href="{{ route('panel.blog.posts.destroy' , $post->id) }}"
                                           onclick="deleteItem(event ,  '{{ route('panel.blog.posts.destroy' , $post->id) }}')"
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