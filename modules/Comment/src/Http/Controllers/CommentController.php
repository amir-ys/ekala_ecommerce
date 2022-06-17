<?php

namespace Modules\Comment\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Comment\Contracts\CommentRepositoryInterface;
use Modules\Comment\Http\Requests\StoreCommentRequest;
use Modules\Comment\Models\Comment;
use Modules\Comment\Repositories\CommentRepo;

class CommentController extends Controller
{
    private CommentRepo $commentRepo;
    public function __construct(CommentRepositoryInterface $commentRepo)
    {
        $this->commentRepo  = $commentRepo;
    }
    public function index()
    {
        $parentComments = $this->commentRepo->getParentComments();
        return view('Comment::index' , compact('parentComments'));
    }

    public function store(StoreCommentRequest $request)
    {
        $this->commentRepo->store($request->all());
        alert()->success('عملیات موفق' , 'کامنت با موفقیت ثبت شد. پس از تایید مدیریت نمایش داده میشود.' );
        return back();
    }

    public function approveStatus($commentId)
    {
        $this->commentRepo->changeStatus($commentId , Comment::STATUS_APPROVED);
        return back();
    }

    public function rejectStatus($commentId)
    {
        $this->commentRepo->changeStatus($commentId , Comment::STATUS_REJECTED);
        return back();
    }

    public function replyShow($commentId)
    {
        $comment = $this->commentRepo->findById($commentId);
        return view('Comment::reply' , compact('comment'));
    }


}
