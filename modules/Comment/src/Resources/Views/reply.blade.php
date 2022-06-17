@extends('Dashboard::master')
@section('title' ,__('Comment::translation.edit'))
@section('breadcrumb')
    <li class="breadcrumb-item"><a
            href="{{ route('panel.categories.index') }}"> @lang('Comment::translation.index') </a></li>
    <li class="breadcrumb-item active"><a> @lang('Comment::translation.edit') {{ $comment->name }}</a></li>
@endsection
@section('content')
    <div class="row" id="store-comment-element">
        <div class="col-12 text-justify" id="comments">
            <div class="row">
                <div class="card">
                    <div class="card-body border border-2 border-primary ">
                        <div class="row">
                            <div class="col-md-2 col-sm-2 col-md-2 pl-md-0 pl-lg-2 pl-xl-3 mb-3">
                                <img width="80px"
                                     src="{{ $comment->user->thumb ?: '/assets/front/assets/images/user-no-image.jpg' }}"
                                     alt="" class="rounded">
                            </div>
                            <div class="col-10 col-sm-10 col-md-10 pr-0 pr-md-2 pr-xl-0 pt-0 pt-lg-1">
                                <div class="name">
                                    {{ $comment->user->name }}
                                </div>
                                <div class="date">ارسال شده
                                    در
                                    {{ getJalaliDate($comment->created_at) }}
                                </div>
                            </div>
                            <div class="col-12">
                                <p>
                                    {{ $comment->body }}
                                </p>
                                <span class="reply"><img src="/assets/front/assets/images/comment-reply.png" alt="">
                                                        <a href=""
                                                           onclick="replyComment(event , '{{ $comment->user->name }}' , '{{ $comment->id }}')"
                                                        > ارسال پاسخ</a></span>
                            </div>
                        </div>


                        <!-- Comment Reply -->
                        @if($comment->comments)
                            @foreach($comment->comments as $replyComment)
                                <div class="row justify-content-end">
                                    <div class="col-11 pt-2 pr-0">
                                        <div class="comment p-3">
                                            <div class="sender-details">
                                                <div class="row">
                                                    <div
                                                        class="col-md-2 col-sm-2 col-md-2 pl-md-0 pl-lg-2 pl-xl-3 mb-3">
                                                        <img width="80px"
                                                             src="{{ $comment->user->thumb ?: '/assets/front/assets/images/user-no-image.jpg' }}"
                                                             alt="" class="rounded">
                                                    </div>
                                                    <div
                                                        class="col-10 col-sm-10 col-md-10 pr-0 pr-md-2 pr-xl-0 pt-0 pt-lg-1">
                                                        <div class="name">
                                                            {{ $comment->user->name }}
                                                        </div>
                                                        <div class="date">ارسال شده
                                                            در
                                                            {{ getJalaliDate($comment->created_at) }}
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <p>
                                                            {{ $comment->body }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <!-- /Comment Reply -->
            </div>
            <!-- /Show Comments -->
        </div>
    </div>


    <!-- Send Comment Form -->
    <div class="comments-container">
        <div class="row pt-4">
            <div class="col-12"><h2>دیدگاه خود را ارسال
                    کنید</h2></div>
        </div>
        @auth
            <div class="row">
                <div class="col-md-12">
                    @if($errors->any())
                        <div class="alert alert-warning">
                            @foreach($errors->all() as $error)
                                <p>{{$error}}</p>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="col-12">
                    <form method="post"
                          action="{{ route('comments.store') }}">
                        @csrf
                        <input type="hidden" id="comment-parent-id" name="parent_id" value>
                        <input type="hidden" name="product_id"
                               value="{{ $comment->commentable->id }}">
                        <div id="send-comment-form">
                            <div id="comment-text">
                                <p>نظر خود را برای این محصول ارسال
                                    کنید.</p>

                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group my-1">
                                                <textarea name="body" class="form-control"
                                                          id="store-comment-textarea"
                                                          rows="4"
                                                          placeholder="متن دیدگاه"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div
                                        class="form-group my-1">
                                        <input type="submit"
                                               value="ارسال دیدگاه"
                                               class="btn btn-success px-5">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @else
            <div class="row">
                <p>
                    برای ثبت نظر برای این محصول لطفا ابتدا وارد
                    <a
                        href="{{ route('login') }}">
                        سایت
                    </a> شوید.
                </p>
            </div>
        @endauth
    </div>
    <!-- /Send Comment Form -->
    </div>
    </div>
    <!-- end row -->
@endsection
