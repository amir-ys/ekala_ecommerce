<?php

namespace Modules\Comment\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Blog\Models\Post;
use Modules\Comment\Contracts\CommentRepositoryInterface;
use Modules\Comment\Http\Requests\StoreCommentRequest;
use Modules\Comment\Models\Comment;
use Modules\Comment\Repositories\CommentRepo;
use Modules\Product\Models\Product;

class CommentController extends Controller
{
    private CommentRepo $commentRepo;
    public function __construct(CommentRepositoryInterface $commentRepo)
    {
        $this->commentRepo  = $commentRepo;
    }
    public function index()
    {
        $this->commentRepo->changeSeen();
        $parentComments = $this->commentRepo->getParentComments();
        return view('Comment::index' , compact('parentComments'));
    }

    public function productCommentsIndex()
    {
        $this->commentRepo->changeSeen(null , Product::class);
        $parentComments = $this->commentRepo->getProductComments();
        return view('Comment::index' , compact('parentComments'));
    }

    public function blogCommentsIndex()
    {
        $this->commentRepo->changeSeen(null , Post::class);
        $parentComments = $this->commentRepo->getBlogComments();
        return view('Comment::index' , compact('parentComments'));
    }

    public function store(StoreCommentRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = auth()->id();

        $this->commentRepo->store($data);
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

    public function changeSeenStatus($commentId = 0)
    {
        $this->commentRepo->changeSeen($commentId);
        newFeedback();
        return  back();
    }


}
