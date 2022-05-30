<?php

namespace Modules\Product\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Brand\Contracts\BrandRepositoryInterface;
use Modules\Category\Contracts\CategoryRepositoryInterface;
use Modules\Product\Contracts\ProductRepositoryInterface;
use Modules\Product\Http\Requests\StoreProductRequest;
use Modules\Product\Http\Requests\UpdateProductRequest;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductImage;
use Modules\Product\Services\ImageService;

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

    public function store(StoreProductRequest $request)
    {
        $product = $this->productRepo->store($request->all());

        //upload primary image
        $imageName = ImageService::uploadImage($request->primary_image, Product::getUploadDirectory());
        $this->productRepo->saveProductImage($imageName, $product, ProductImage::IS_PRIMARY_TRUE);
        //other images
        if ($request->hasFile('images')) {
            $images = $request->images;
            foreach ($images as $image) {
                $imageName = ImageService::uploadImage($image, Product::getUploadDirectory());
                $this->productRepo->saveProductImage($imageName, $product, ProductImage::IS_PRIMARY_FALSE);
            }
        }
        newFeedback();
        return redirect()->route('panel.products.index');
    }

    public function edit($productId)
    {
        $product = $this->productRepo->findByIdWithRelations($productId);
        $brands = (resolve(BrandRepositoryInterface::class))->all();
        $categories = (resolve(CategoryRepositoryInterface::class))->all();
        return view('Product::edit', compact( 'product','brands', 'categories'));
    }

    public function update(UpdateProductRequest $request , $productId)
    {
        //update product
        $product = $this->productRepo->update($productId ,  $request->all());


        //upload primary image
        if ($request->hasFile('primary_image')){
        //delete old image
        ImageService::deleteImage($product->primaryImage->name , Product::getUploadDirectory());

        //upload new image
        $imageName = ImageService::uploadImage($request->primary_image, Product::getUploadDirectory());
        $this->productRepo->updateProductImage($imageName, $product , ProductImage::IS_PRIMARY_TRUE);
        }

        //other images
        if ($request->hasFile('images')) {
            $images = $request->images;
            foreach ($images as $image) {
                $imageName = ImageService::uploadImage($image, Product::getUploadDirectory());
                $this->productRepo->saveProductImage($imageName, $product, ProductImage::IS_PRIMARY_FALSE);
            }
        }
        newFeedback();
        return redirect()->route('panel.products.index');
    }
}
