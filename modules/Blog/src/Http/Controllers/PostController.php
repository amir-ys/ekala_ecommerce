<?php

namespace Modules\Blog\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Blog\Contracts\PostRepositoryInterface;
use Modules\Blog\Http\Requests\PostRequest;
use Modules\Blog\Models\Category;
use Modules\Blog\Models\Post;
use Modules\Core\Responses\AjaxResponse;
use Modules\Core\Services\ImageService;
class PostController extends Controller
{
    private PostRepositoryInterface $postRepo;

    public function __construct(PostRepositoryInterface $postRepo)
    {
        $this->postRepo = $postRepo;
    }

    public function index()
    {
        $this->authorize('view', Post::class);
        $posts = $this->postRepo->getAll();
        return view('Blog::posts.index', compact('posts'));
    }

    public function create()
    {
        $this->authorize('manage', Post::class);
        $categories = Category::all();
        return view('Blog::posts.create', compact('categories'));
    }

    public function store(PostRequest $request)
    {
        $this->authorize('manage', Post::class);
        $post = $this->postRepo->store($request->all());

        $this->saveImage($request->file('image'), $post);

        newFeedback();
        return to_route('panel.blog.posts.index');
    }

    public function edit($postId)
    {
        $this->authorize('manage', Post::class);
        $post = $this->postRepo->findById($postId);
        $categories = Category::all();
        return view('Blog::posts.edit', compact('post', 'categories'));
    }

    public function update(PostRequest $request, $postId)
    {
        $this->authorize('manage', Post::class);
        $post = $this->postRepo->findById($postId);

        $this->postRepo->update($postId, $request->validated());
        $this->saveImage($request->file('image'), $post, true);

        newFeedback();
        return to_route('panel.blog.posts.index');
    }

    public function destroy($postId)
    {
        $this->authorize('manage', Post::class);
        $post = $this->postRepo->findById($postId);
        $this->postRepo->destroy($postId);
        return AjaxResponse::success("پست " . $post->name . " با موفقیت حذف شد.");
    }

    private function saveImage($file, $post, $isUpdate = false)
    {
        if (is_null($file)) {
            return null;
        }
        $images = $this->uploadImage($file, $post, $isUpdate);
        $this->postRepo->updateImageById($post->id, $images);
    }

    private function uploadImage($file, Post $post, $isUpdate = false)
    {
        if ($file) {

            if ($isUpdate) {
                $this->deleteImage($post->image, $post);
            }

            return ImageService::uploadImage($file, 'blog', $post->getUploadDir(), $post->getImageName());
        }
        return $post->image;

    }

    private function deleteImage($fileNames, $post)
    {
        ImageService::deleteImage($fileNames, $post->getUploadDir());
    }

    public function showImage($postId)
    {
        $post = $this->postRepo->findById($postId);
        return ImageService::loadImage($post->image['large'], $post->getUploadDir());
    }
}
