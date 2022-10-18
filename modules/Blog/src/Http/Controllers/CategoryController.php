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
    private CategoryRepositoryInterface $categoryRepo;

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
        $category = $this->categoryRepo->store($data);
       $this->saveImage($request->file('image') , $category);
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
        $this->categoryRepo->update($categoryId, $data);

        $this->saveImage($request->file('image'), $category , true);

        newFeedback();
        return to_route('panel.blog.categories.index');
    }

    public function destroy($categoryId)
    {
        $category = $this->categoryRepo->findById($categoryId);
        $this->categoryRepo->destroy($categoryId);
        return AjaxResponse::success("دسته بندی " . $category->name . " با موفقیت حذف شد.");
    }

    private function saveImage(UploadedFile $file , $category , $isUpdate = false)
    {
        $images = $this->uploadImage($file , $category  , $isUpdate);
        $this->categoryRepo->updateImageById($category->id , $images);
    }

    private function uploadImage($file, Category $category ,$isUpdate = false)
    {
        if ($file) {

            if ($isUpdate){
                $this->deleteImage($category->image , $category);
            }

           return ImageService::uploadImage($file, 'blog' ,  $category->getUploadDir(), $category->getImageName());
        }
        return $category->image;

    }

    private function deleteImage($fileNames , $category)
    {
        ImageService::deleteImage($fileNames, $category->getUploadDir());
    }

    public function showImage($categoryId)
    {
        $category = $this->categoryRepo->findById($categoryId);
        return ImageService::loadImage($category->image['large'], $category->getUploadDir());
    }

}
