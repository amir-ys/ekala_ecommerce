<?php

namespace Modules\Front\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Blog\Contracts\CategoryRepositoryInterface;
use Modules\Blog\Contracts\PostRepositoryInterface;
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
        $viewCount = resolve(PostRepositoryInterface::class)->incrementVisit($post->id);
        return view('Front::blog.single', compact('post' , 'viewCount'));
    }

    public function postCategory($categorySlug)
    {
        $posts = resolve(CategoryRepositoryInterface::class)->getAllWithSpecialSlug($categorySlug);
        return view('Front::blog.category-posts', compact('posts'));
    }

    public function showImage($postId)
    {
        $post = resolve(PostRepositoryInterface::class)->findById($postId);
        return ImageService::loadImage($post->image['large'], $post->getUploadDir());
    }

    public function postTags($tag)
    {
        $posts = $this->findPostWithTag($tag);
        return view('Front::blog.tag-posts', compact('posts'));
    }

    public function findPostWithTag($tag)
    {
        $postRepo = resolve(PostRepositoryInterface::class);
        $allPosts = $postRepo->getAll();
        $postIds = $this->getPostIdsByTag($allPosts , $tag);
       return $postRepo->getPostsByIds($postIds);
    }

    public function getPostIdsByTag($posts , $tag)
    {
        $postIds = [];
        foreach ($posts  as $post){
            if (is_array($post->tags) &&  in_array($tag , $post->tags)){
                $postIds[] = $post->id;
            }
        }
        return $postIds;
    }


}
