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
        $defaultProductColor = resolve(ProductRepositoryInterface::class)->findDefaultProductColor($product->id);
        //todo $relatedProduct
        $relatedProducts = resolve(ProductRepositoryInterface::class)->getAll();
        $viewCount = resolve(ProductRepositoryInterface::class)->incrementVisit($product->id);
        return view('Front::products.details' , compact('product' , 'relatedProducts' , 'viewCount' , 'defaultProductColor'));
    }

    public function list(Request $request)
    {
        $categories = resolve(CategoryRepositoryInterface::class)->allParent();
        $products = resolve(ProductRepositoryInterface::class)->getProductsOrderByRequest();
        return view('Front::products.product-list' , compact('products' , 'categories'));
    }
}
