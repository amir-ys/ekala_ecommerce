<?php

namespace Modules\Product\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Brand\Contracts\BrandRepositoryInterface;
use Modules\Category\Contracts\CategoryRepositoryInterface;
use Modules\Product\Contracts\ProductRepositoryInterface;
use Modules\Product\Http\Requests\ProductRequest;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductImage;
use Modules\Product\Services\ImageUploadService;

class ProductController extends Controller
{
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepo = $productRepository;
    }

    public function index()
    {
        $products = $this->productRepo->getAll();
        return view('Product::index', compact('products'));
    }

    public function create()
    {
        $brands = (resolve(BrandRepositoryInterface::class))->all();
        $categories = (resolve(CategoryRepositoryInterface::class))->all();
        return view('Product::create', compact('brands', 'categories'));
    }

    public function store(ProductRequest $request)
    {
        $product = $this->productRepo->store($request->all());

        //upload primary image
        $imageName = ImageUploadService::uploadImage($request->primary_image, Product::getUploadDirectory());
        $this->productRepo->saveProductImage($imageName, $product, ProductImage::IS_PRIMARY_TRUE);
        //other images
        if ($request->hasFile('images')) {
            $images = $request->images;
            foreach ($images as $image) {
                $imageName = ImageUploadService::uploadImage($image, Product::getUploadDirectory());
                $this->productRepo->saveProductImage($imageName, $product, ProductImage::IS_PRIMARY_FALSE);
            }
        }
        newFeedback();
        return redirect()->route('panel.products.index');
    }
}
