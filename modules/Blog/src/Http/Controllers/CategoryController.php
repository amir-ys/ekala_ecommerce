<?php

namespace Modules\Blog\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\UploadedFile;
use Modules\Blog\Contracts\CategoryRepositoryInterface;
use Modules\Blog\Http\Requests\CategoryRequest;
use Modules\Blog\Models\Category;
use Modules\Blog\Repositories\CategoryRepo;
use Modules\Core\Responses\AjaxResponse;
use Modules\Product\Services\ImageService;

class CategoryController extends Controller
{
    private CategoryRepo $categoryRepo;

    public function __construct(CategoryRepositoryInterface $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    public function index()
    {
        $categories = $this->categoryRepo->getAll();
        return view('Blog::categories.index', compact('categories'));
    }

    public function create()
    {
        return view('Blog::categories.create');
    }

    public function store(CategoryRequest $request)
    {
        $data = $request->all();
        $data['image'] = $this->uploadImage($request->file('image'));
        $this->categoryRepo->store($data);
        newFeedback();
        return to_route('panel.blog.categories.index');
    }

    public function edit($categoryId)
    {
        $category = $this->categoryRepo->findById($categoryId);
        return view('Blog::categories.edit', compact('category'));
    }

    public function update(CategoryRequest $request, $categoryId)
    {
        $data = $request->all();
        $category = $this->categoryRepo->findById($categoryId);

        $data['image'] =  $this->updateImage($request, $category);
        $this->categoryRepo->update($categoryId, $data);

        newFeedback();
        return to_route('panel.blog.categories.index');
    }

    public function destroy($categoryId)
    {
        $category = $this->categoryRepo->findById($categoryId);
        $this->categoryRepo->destroy($categoryId);
        return AjaxResponse::success("دسته بندی " . $category->name . " با موفقیت حذف شد.");
    }

    private function uploadImage(UploadedFile $file)
    {
        return ImageService::uploadImage($file, Category::getUploadDir(), Category::getImageName());
    }

    private function updateImage($request, Category $category)
    {
        if ($request->hasFile('image')) {
            $this->deleteImage($category->image);
            $res = $this->uploadImage($request->file('image'));
        } else {
            $res = $category->image;
        }
        return $res;
    }

    private function deleteImage(UploadedFile $file)
    {
        ImageService::deleteImage($file, Category::getUploadDir());
    }

    public function showImage($name)
    {
        return ImageService::loadImage($name, Category::getUploadDir());
    }

}
