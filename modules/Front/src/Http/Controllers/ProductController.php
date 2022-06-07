<?php

namespace Modules\Front\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Category\Contracts\CategoryRepositoryInterface;
use Modules\Product\Contracts\ProductRepositoryInterface;

class ProductController extends Controller
{
    public function show($productSlug)
    {
        $product = resolve(ProductRepositoryInterface::class)->findBySlug($productSlug);
        return view('Front::products.details' , compact('product'));
    }


}
