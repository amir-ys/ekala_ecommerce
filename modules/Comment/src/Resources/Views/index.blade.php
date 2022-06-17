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
                                <th>متن کامنت</th>
                                <th> برای کاربر ؟</th>
                                <th> برای نوع ؟</th>
                                <th> تاریخ ایجاد</th>
                                <th> وضعیت تایید</th>
                                <th> عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($parentComments as $comment)
                                <tr>
                                    <td>{{ $loop->iteration  }}</td>
                                    <td>{{ substr($comment->body , 0 , 50) }}</td>
                                    <td>{{ $comment->user->name }}</td>
                                    <td>{{ $comment->commentableType }}</td>
                                    <td>{{ getJalaliDate($comment->created_at) }}</td>
                                    <td>
                                        <span
                                            class="badge py-1 bg-{{ $comment->statusCssClass }}"> {{ $comment->statusName }}
                                        </span>
                                    </td>

                                    <td>
                                        <a class="btn btn-success btn-sm bg-transparent d-inline text-black-50 ml-2"
                                           href="#" onclick="approveStatus( event ,'{{ $comment->id }}')">
                                            تایید
                                        </a>

                                        <a class="btn btn-danger btn-sm bg-transparent d-inline text-black-50 mt-2"
                                           href="#" onclick="rejectStatus('{{ $comment->id }}')">
                                            رد
                                        </a>



                                        <a class="btn btn-primary btn-sm bg-transparent d-inline text-black-50 mr-2"
                                           href="{{ route('panel.comments.replies.show' , $comment->id) }}">
                                            پاسخ
                                        </a>

                                    </td>

                                    <form action="{{ route('panel.comments.rejectStatus' , $comment->id ) }}" method="post"
                                          id="comment-reject-status-{{$comment->id}}">
                                        @csrf
                                        @method('patch')
                                    </form>
                                    <form action="{{ route('panel.comments.approveStatus' , $comment->id ) }}" method="post"
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
