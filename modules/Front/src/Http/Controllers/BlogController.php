<?php

namespace Modules\Front\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Blog\Contracts\CategoryRepositoryInterface;
use Modules\Blog\Contracts\PostRepositoryInterface;
use Modules\Blog\Models\Post;
use Modules\Product\Services\ImageService;

class BlogController extends Controller
{

    public function index(Request $request)
    {
        $posts = resolve(PostRepositoryInterface::class)->getAll();
        return view('Front::blog.index', compact('posts'));
    }

    public function postDetails($postSlug)
    {
        $post = resolve(PostRepositoryInterface::class)->findBySlug($postSlug);
        return view('Front::blog.single', compact('post'));
    }

    public function postCategory($categorySlug)
    {
        $posts = resolve(CategoryRepositoryInterface::class)->getAllWithSpecialSlug($categorySlug);
        return view('Front::blog.category-post', compact('posts'));
    }

    public function showImage($imageName)
    {
        return ImageService::loadImage($imageName, Post::getUploadDir());
    }
}
