<div id="comments-tab" class="tabs-container px-0 px-md-3 pb-0 pb-md-2" style="display: none">
    <div class="row" id="store-comment-element">
        <div class="col-12 text-justify" id="comments">
            <div class="comments-container">
                <div class="container px-0">
                    <div class="row">
                        <div class="col-12 pt-2">
                            <!-- Show Comments -->
                            @foreach($model->approvedComments as $comment)
                                <div class="comment p-3 my-2">
                                    @include('Front::partials.comment-box' , ['comment' => $comment , 'isReply' => false])
                                    <!-- Comment Reply -->
                                    @if($comment->comments->count() > 0)
                                        @foreach($comment->comments->load('user') as $replyComment)
                                            <div class="row justify-content-end">
                                                <div class="col-11 pt-2 pr-0">
                                                    <div class="comment p-3">
                                                        @include('Front::partials.comment-box' , ['comment' => $replyComment , 'isReply' => true])
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                    <!-- /Comment Reply -->
                                </div>
                            @endforeach
                            <!-- /Show Comments -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Send Comment Form -->
            <div class="comments-container" >
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
                        <div class="col-12" >
                            <form method="post"
                                  action="{{ route('comments.store') }}">
                                @csrf
                                <input type="hidden" id="comment-parent-id" name="parent_id" value>
                                <input type="hidden" name="model_id" value="{{ $model->id }}">
                                <input type="hidden" name="model_type" value="{{ get_class($model) }}">
                                <div id="send-comment-form">
                                   <div id="comment-text">
                                       <p>نظر خود را برای این {{ $type }} ارسال
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
                            برای ثبت نظر برای این {{ $type }} لطفا ابتدا وارد
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
</div>
