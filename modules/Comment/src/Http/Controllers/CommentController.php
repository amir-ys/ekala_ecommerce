<?php

namespace Modules\Comment\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Comment\Contracts\CommentRepositoryInterface;
use Modules\Comment\Http\Requests\StoreCommentRequest;
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
        $comments = $this->commentRepo->getAll();
        return view('Comment::index' , compact('comments'));
    }

    public function store(StoreCommentRequest $request)
    {
        $this->commentRepo->store($request->all());
        alert()->success('عملیات موفق' , 'کامنت با موفقیت ثبت شد. پس از تایید مدیریت نمایش داده میشود.' );
        return back();
    }
}
