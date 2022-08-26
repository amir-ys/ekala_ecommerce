<?php

namespace Modules\Blog\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Modules\Blog\Contracts\PostRepositoryInterface;
use Modules\Blog\Http\Requests\PostRequest;
use Modules\Blog\Models\Category;
use Modules\Blog\Models\Post;
use Modules\Core\Responses\AjaxResponse;
use Modules\Product\Services\ImageService;

class PostController extends Controller
{
    private PostRepositoryInterface $postRepo;

    public function __construct(PostRepositoryInterface $postRepo)
    {
        $this->postRepo = $postRepo;
    }

    public function index()
    {
        $posts = $this->postRepo->getAll();
        return view('Blog::posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('Blog::posts.create', compact('categories'));
    }

    public function store(PostRequest $request)
    {
        $data = $request->all();
        $data['author_id'] = auth()->id();
        $data['image'] = $this->uploadImage($request->file('image'));
        $data['published_at'] = convertJalaliToDate($request->published_at);

        $this->postRepo->store($data);
        newFeedback();
        return to_route('panel.blog.posts.index');
    }

    public function edit($postId)
    {
        $post = $this->postRepo->findById($postId);
        $categories = Category::all();
        return view('Blog::posts.edit', compact('post', 'categories'));
    }

    public function update(PostRequest $request, $postId)
    {
        $data = $request->all();
        $post = $this->postRepo->findById($postId);

        $data['author_id'] = auth()->id();
        $data['image'] = $this->updateImage($request, $post);
        $data['published_at'] = convertJalaliToDate($request->published_at);

        $this->postRepo->update($postId, $data);

        newFeedback();
        return to_route('panel.blog.posts.index');
    }

    public function destroy($postId)
    {
        $post = $this->postRepo->findById($postId);
        $this->deleteImage($post->image);
        $this->postRepo->destroy($postId);
        return AjaxResponse::success("پست " . $post->name . " با موفقیت حذف شد.");
    }

    private function uploadImage(UploadedFile $file)
    {
        return ImageService::uploadImage($file, Post::getUploadDir(), Post::getImageName());
    }

    private function updateImage($request, Post $post)
    {
        if ($request->hasFile('image')) {
            $this->deleteImage($post->image);
            return $this->uploadImage($request->file('image'));
        }
        return $post->image;

    }

    private function deleteImage($file)
    {
        ImageService::deleteImage($file, Post::getUploadDir());
    }

    public function showImage($name)
    {
        return ImageService::loadImage($name, Post::getUploadDir());
    }
}
