@extends('Dashboard::master')
@section('title'  ,__('Comment::translation.index'))
@section('breadcrumb')
    <li class="breadcrumb-item active"><a>@lang('Comment::translation.index')</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="row mb-3">
                <div class="col-sm-12 col-md-12 col-lg-2">
                    <a href="{{ route('panel.comments.create') }}"
                       class="btn btn-primary
                        btn-rounded waves-effect waves-light mb-2 me-2">
                        <i class="mdi mdi-plus me-1"></i>
                        @lang('Comment::translation.create')</a>
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
                                <th>دسته پدر</th>
                                <th> تاریخ ایجاد</th>
                                <th>قابل فیلتر است ؟</th>
                                <th>وضعیت</th>
                                <th> عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($comments as $comment)
                                <tr>
                                    <td>{{ $loop->iteration  }}</td>
                                    <td>{{ $comment->name }}</td>
                                    <td>{{ $comment->parent_id ? $comment->parent->name : 'ندارد' }}</td>
                                    <td>{{ getJalaliDate($comment->created_at) }}</td>
                                    <td>
                                          <span
                                                  class="badge py-1 badge-{{ $comment->is_searchable == \Modules\Comment\Models\Comment::SEARCHABLE_TRUE
                                                      ? 'success'  : 'danger'   }}">
                                              {{ $comment->is_searchable == \Modules\Comment\Models\Comment::SEARCHABLE_TRUE
                                                      ? 'بله'  : 'خیر'   }}
                                        </span>
                                    </td>
                                    <td>
                                        <span
                                                class="badge py-1 bg-{{ $comment->statusCssClass }}"> @lang($comment->is_active->name)
                                        </span>
                                    </td>

                                    <td>
                                        <a class="btn btn-sm bg-transparent d-inline"
                                           href="{{ route('panel.comments.edit' , $comment->id) }}"><i
                                                    class="fa fa-pencil fa-15m text-success"></i></a>

                                        <a href="{{ route('panel.comments.destroy' , $comment->id) }}"
                                           onclick="deleteItem(event ,  '{{ route('panel.comments.destroy' , $comment->id) }}')"
                                           class="btn btn-sm bg-transparent d-inline delete-confirm"><i
                                                    class="fa fa-trash fa-15m text-danger"></i></a>

                                        <form action="{{ route('panel.comments.destroy' , $comment->id) }}"
                                              method="post"
                                              id="destroy-brand-{{ $comment->id }}">
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
