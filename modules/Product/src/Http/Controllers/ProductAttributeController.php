<?php

namespace Modules\Product\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Product\Contracts\ProductRepositoryInterface;
use Modules\Product\Http\Requests\SaveProductAttributeRequest;

class ProductAttributeController extends Controller
{
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepo = $productRepository;
    }

    public function show($productId)
    {
        $product = $this->productRepo->findByIdWithCategory($productId);
        return view('Product::attributes.show' , compact('product'));
    }

    public function saveAttributeValue(SaveProductAttributeRequest $request , $productId)
    {
         $this->productRepo->attachAttributeWithValue($productId , $request->input('attributes'));
         newFeedback();
         return  back();
    }
}
