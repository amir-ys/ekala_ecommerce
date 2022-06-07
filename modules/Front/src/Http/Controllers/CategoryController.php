<?php

namespace Modules\Front\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Category\Contracts\CategoryRepositoryInterface;
use Modules\Product\Contracts\ProductRepositoryInterface;

class CategoryController extends Controller
{
    public function show($productSlug)
    {
        $category = resolve(CategoryRepositoryInterface::class)->findBySlug($productSlug);
        return view('Front::products.categories' , compact('category'));
    }


}
