<?php

namespace Modules\Product\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Product\Contracts\ProductRepositoryInterface;
use Modules\Product\Http\Requests\UploadImageRequest;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductImage;
use Modules\Core\Services\ImageService;
class ProductImageController extends Controller
{
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepo = $productRepository;
    }

    public function show($productId)
    {
        $this->authorize('view', Product::class);
        $product = $this->productRepo->findByIdWithImages($productId);
        $images = $this->productRepo->getImages($productId);
        return view('Product::images.show', compact('product', 'images'));
    }

    public function display($productId, $imageName)
    {
        $product = $this->productRepo->findById($productId);
        return ImageService::loadImage($imageName, $product->getUploadDirectory());
    }

    public function upload(UploadImageRequest $request, $productId)
    {
        $this->authorize('manage', Product::class);
        $product = $this->productRepo->findByIdWithImages($productId);

        if ($request->hasFile('primary_image')) {
            if ($product->primaryImage) {
                $this->productRepo->deletePrimaryImage($productId);
                ImageService::deleteImage($product->primaryImage->images, $product->getUploadDirectory());
            }
            $name = ImageService::uploadImage($request->file('primary_image'), 'product', $product->getUploadDirectory());
            $this->productRepo->storeProductImage($name, $productId, ProductImage::IS_PRIMARY_TRUE);
        } elseif ($request->hasFile('images')) {
            $images = $request->images;
            foreach ($images as $image) {
                $name = ImageService::uploadImage($image, 'product', $product->getUploadDirectory());
                $this->productRepo->storeProductImage($name, $productId, ProductImage::IS_PRIMARY_FALSE);
            }
        }
        newFeedback('عملیات موفق', 'فایل با موفقیت آپلود شد');
        return back();
    }

    public function deleteImage($productId, $imageId)
    {
        $this->authorize('manage', Product::class);
        $product = $this->productRepo->findById($productId);
        $image = $this->productRepo->findImageById($productId, $imageId);
        $this->productRepo->deleteImageById($product->id, $image->id);
        ImageService::deleteImage($image->images, $product->getUploadDirectory());
        newFeedback('عملیات موفق', 'فایل با موفقیت حذف شد');
        return back();
    }

    public function deleteAllImages($productId)
    {
        $this->authorize('manage', Product::class);
        $product = $this->productRepo->findById($productId);
        $images = $this->productRepo->getImages($productId);
        foreach ($images as $image) {
            $this->productRepo->deleteImageById($product->id, $image->id);
            ImageService::deleteImage($image->images, $product->getUploadDirectory());
        }
        newFeedback('عملیات موفق', 'عکس ها با موفقیت حذف شد.');
        return back();
    }
}
