<?php

namespace Modules\Category\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Category\Contracts\CategoryRepositoryInterface;
use Modules\Category\Http\Requests\CategoryRequest;
use Modules\Category\Models\Category;

class CategoryController extends Controller
{
    private  $categoryRepo;
    public function __construct(CategoryRepositoryInterface $categoryRepo)
    {
        $this->categoryRepo  = $categoryRepo;
    }
    public function index()
    {
        $categories = $this->categoryRepo->getAllPaginate();
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


}
