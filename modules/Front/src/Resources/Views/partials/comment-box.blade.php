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
            @if(!$isReply)
                <span class="reply">
                <img
                    src="/assets/front/assets/images/comment-reply.png"
                    alt=""> ارسال پاسخ</span>
            @endif
        </div>
    </div>
</div>