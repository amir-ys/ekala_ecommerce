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
        $productRepo = resolve(ProductRepositoryInterface::class);
        $product = $productRepo->findBySlug($productSlug);
        $productRepo->incrementVisit($product);
        $defaultProductColor = $productRepo->findDefaultProductColor($product);
        $relatedProducts = $productRepo->getRelatedProducts($product);
        return view('Front::products.details' , compact('product' , 'relatedProducts' , 'defaultProductColor'));
    }

    public function list(Request $request)
    {
        $categories = resolve(CategoryRepositoryInterface::class)->getSearchable();
        $products = resolve(ProductRepositoryInterface::class)->getProductsOrderByRequest();
        return view('Front::products.product-list' , compact('products' , 'categories'));
    }

    public function categoryProducts(Request $request , $categorySlug)
    {
        $category = resolve(CategoryRepositoryInterface::class)->findBySlug($categorySlug);
        $products = resolve(ProductRepositoryInterface::class)->getProductsOrderByRequest($category->id);
        return view('Front::products.product-list' , compact('products'));
    }
}
