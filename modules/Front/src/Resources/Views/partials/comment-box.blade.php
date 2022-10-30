<div class="sender-details">
    <div class="row">
        <div
            class="col-3 col-sm-2 col-md-1 pl-md-0 pl-lg-2 pl-xl-3">
            <img
                src="{{ $comment->user->thumb ?: '/assets/front/assets/images/user-no-image.jpg' }}"
                alt="" class="rounded">
        </div>
        <div
            class="col-9 col-sm-10 col-md-11 pr-0 pr-md-2 pr-xl-0 pt-0 pt-lg-1">
            <div class="name">
                {{ $comment->user->username ?? $comment->user->email  }}
            </div>
            @if($comment->user->isAdmin())
                <div class="name mr-md-5">
                    <span class="badge bg-primary" > پاسخ مدیریت</span>
                </div>
            @endif
            <div class="date">ارسال شده
                در
                {{ getJalaliDate($comment->created_at) }}
            </div>
        </div>
        <div class="col-12">
            <p>
                {{ $comment->body }}
            </p>
            @if(!$isReply)
                <span class="reply">
                <img
                    src="/assets/front/assets/images/comment-reply.png" alt="">
                    <a href="" onclick="replyComment(event , '{{ $comment->user->username ?? $comment->user->email }}' , '{{ $comment->id }}')"> ارسال پاسخ</a>
                </span>
            @endif
        </div>
    </div>
</div>
