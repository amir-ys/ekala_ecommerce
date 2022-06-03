<?php

namespace Modules\Category\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\AttributeGroup\Contracts\AttributeGroupRepositoryInterface;
use Modules\Category\Contracts\CategoryRepositoryInterface;
use Modules\Category\Http\Requests\CategoryRequest;
use Modules\Category\Repositories\CategoryRepo;
use Modules\Core\Responses\AjaxResponse;

class CategoryController extends Controller
{
    private CategoryRepo $categoryRepo;
    public function __construct(CategoryRepositoryInterface $categoryRepo)
    {
        $this->categoryRepo  = $categoryRepo;
    }
    public function index()
    {
        $categories = $this->categoryRepo->getAll();
        return view('Category::index' , compact('categories'));
    }

    public function create()
    {
        $parentCategories = $this->categoryRepo->getParentCategories();
        return view('Category::create' , compact('parentCategories'));
    }

    public function store(CategoryRequest $request)
    {
        $this->categoryRepo->store($request->all());
        newFeedback();
        return to_route('panel.categories.index');
    }

    public function edit($categoryId)
    {
        $category = $this->categoryRepo->findById($categoryId);
        $parentCategories = $this->categoryRepo->getParentCategoriesExceptId($categoryId);
        return view('Category::edit' , compact( 'category' ,'parentCategories'));
    }

    public function update(CategoryRequest $request , $categoryId)
    {
        $this->categoryRepo->update($categoryId ,$request->all());
        newFeedback();
        return to_route('panel.categories.index');
    }

    public function destroy($categoryId)
    {
        $category =$this->categoryRepo->findById($categoryId);
        $categoryChildes = $this->categoryRepo->checkHasChildes($categoryId);
        if ($categoryChildes){
            return  AjaxResponse::error('این دسته بندی شامل زیر دسته است و قابل حذف نیست.');
        }

        $this->categoryRepo->detachAttributeGroupFromCategory($categoryId);
        $this->categoryRepo->destroy($categoryId);
        return AjaxResponse::success("دسته بندی ". $category->name ." با موفقیت حذف شد.");
    }

}
