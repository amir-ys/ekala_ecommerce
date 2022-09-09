<?php

namespace Modules\Front\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Category\Contracts\CategoryRepositoryInterface;
use Modules\Product\Contracts\ProductRepositoryInterface;

class ProductController extends Controller
{
    public function show($productSlug)
    {
        $product = resolve(ProductRepositoryInterface::class)->findBySlug($productSlug);
        //todo $relatedProduct
        $relatedProducts = resolve(ProductRepositoryInterface::class)->getAll();
        return view('Front::products.details' , compact('product' , 'relatedProducts'));
    }

    public function list(Request $request)
    {
        $categories = resolve(CategoryRepositoryInterface::class)->allParent();
        $products = resolve(ProductRepositoryInterface::class)->getProductsOrderByRequest();
        return view('Front::products.product-list' , compact('products' , 'categories'));
    }
}
