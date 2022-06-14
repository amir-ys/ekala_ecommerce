<?php

namespace Modules\Comment\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Comment\Contracts\CommentRepositoryInterface;
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
}
