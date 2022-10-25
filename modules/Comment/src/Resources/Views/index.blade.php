@extends('Dashboard::master')
@section('title'  ,__('Comment::translation.index'))
@section('breadcrumb')
    <li class="breadcrumb-item active"><a>
            @lang('Comment::translation.index')
        </a></li>
@endsection
@section('content')
    @if(auth()->user()->hasPermissionTo(\Modules\RolePermissions\Models\Permission::PERMISSION_MANAGE_COMMENTS))
        <div class="row mb-md-2">
            <div class="col-md-12">
                <div class="col-md-6">
                    <a href="{{ route('panel.comments.productIndex') }}"
                       class="btn btn-outline-danger">@lang('Comment::translation.productIndex')</a>
                    <a href="{{ route('panel.comments.blogIndex') }}"
                       class="btn btn-outline-primary">@lang('Comment::translation.blogIndex')</a>
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body border border-5">
                    <div class="table-responsive">
                        <table id="table" class="table table-hover">
                            <thead class="thead-light">
                            <tr>
                                <th>شناسه</th>
                                <th>متن کامنت</th>
                                <th> برای کاربر ؟</th>
                                <th> برای نوع ؟</th>
                                <th> تاریخ ایجاد</th>
                                <th> وضعیت تایید</th>
                                @if(auth()->user()->hasPermissionTo(\Modules\RolePermissions\Models\Permission::PERMISSION_MANAGE_COMMENTS))
                                    <th> عملیات</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($parentComments as $comment)
                                <tr>
                                    <td>{{ $loop->iteration  }}</td>
                                    <td>{{ str($comment->body)->limit(20) }}</td>
                                    <td>{{ $comment->user->username }}</td>
                                    <td>{{ $comment->commentable_type_name }}</td>
                                    <td>{{ getJalaliDate($comment->created_at) }}</td>
                                    <td>
                                        <span
                                            class="badge py-1 bg-{{ $comment->statusCssClass }}"> {{ $comment->statusName }}
                                        </span>
                                    </td>

                                    @if(auth()->user()->hasPermissionTo(\Modules\RolePermissions\Models\Permission::PERMISSION_MANAGE_COMMENTS))
                                        <td>
                                            @if($comment->is_approved)
                                                <a class="btn btn-danger btn-sm bg-transparent d-inline text-black-50 ml-2 w-100"
                                                   href="#" onclick="rejectStatus('{{ $comment->id }}')">
                                                    رد
                                                </a>

                                            @else
                                                <a class="btn btn-success btn-sm bg-transparent d-inline text-black-50 ml-1 w-100"
                                                   href="#" onclick="approveStatus( event ,'{{ $comment->id }}')">
                                                    تایید
                                                </a>
                                            @endif


                                            <a class="btn btn-primary btn-sm bg-transparent d-inline text-black-50 mr-2"
                                               href="{{ route('panel.comments.replies.show' , $comment->id) }}">
                                                پاسخ
                                            </a>

                                        </td>
                                    @endif

                                    <form action="{{ route('panel.comments.rejectStatus' , $comment->id ) }}"
                                          method="post"
                                          id="comment-reject-status-{{$comment->id}}">
                                        @csrf
                                        @method('patch')
                                    </form>
                                    <form action="{{ route('panel.comments.approveStatus' , $comment->id ) }}"
                                          method="post"
                                          id="comment-approve-status-{{$comment->id}}">
                                        @csrf
                                        @method('patch')
                                    </form>
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
@section('script')
    <script>
        function approveStatus(event, id) {
            event.preventDefault();
            document.getElementById('comment-approve-status-' + id).submit()
        }
    </script>

    <script>
        function rejectStatus(id) {
            document.getElementById('comment-reject-status-' + id).submit()
        }
    </script>
@endsection
