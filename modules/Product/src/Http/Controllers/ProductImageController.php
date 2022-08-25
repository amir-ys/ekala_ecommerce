<?php

namespace Modules\Product\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Product\Contracts\ProductRepositoryInterface;
use Modules\Product\Http\Requests\UploadImageRequest;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductImage;
use Modules\Product\Services\ImageService;

class ProductImageController extends Controller
{
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepo = $productRepository;
    }

    public function show($productId)
    {
        $product = $this->productRepo->findByIdWithImages($productId);
        $images = $this->productRepo->getProductImages($productId);
        return view('Product::images.show', compact('product', 'images'));
    }


    public function display($imageName)
    {
        return ImageService::loadImage($imageName, Product::getUploadDirectory());
    }

    public function upload(UploadImageRequest $request, $productId)
    {
        $product = $this->productRepo->findByIdWithImages($productId);
        if ($request->hasFile('primary_image')) {
            if ($product->primaryImage) {
                $this->productRepo->deletePrimaryImage($productId);
                ImageService::deleteImage($product->primaryImage->name, Product::getUploadDirectory());
            }
            $name = ImageService::uploadImage($request->file('primary_image'), Product::getUploadDirectory());
            $this->productRepo->storeProductImage($name, $productId, ProductImage::IS_PRIMARY_TRUE);
        } elseif ($request->hasFile('images')) {
            $images = $request->images;
            foreach ($images as $image) {
                $name = ImageService::uploadImage($image, Product::getUploadDirectory());
                $this->productRepo->storeProductImage($name, $productId, ProductImage::IS_PRIMARY_FALSE);
            }
        }
        newFeedback('عملیات موفق', 'فایل با موفقیت آپلود شد');
        return back();
    }

    public function deleteImage($productId, $imageId)
    {
        $image = $this->productRepo->findImageById($productId, $imageId);
        $this->productRepo->deleteProductImage($image);
        ImageService::deleteImage($image->name, Product::getUploadDirectory());
        newFeedback('عملیات موفق', 'فایل با موفقیت حذف شد');
        return back();
    }

    public function deleteAllImages($productId)
    {
        $images = $this->productRepo->getProductImages($productId);
        foreach ($images as $image) {
            $this->productRepo->deleteProductImage($image);
            ImageService::deleteImage($image->name, Product::getUploadDirectory());
        }
        newFeedback('عملیات موفق', 'عکس ها با موفقیت حذف شد.');
        return back();
    }
}
