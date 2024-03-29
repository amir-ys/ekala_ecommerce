<?php

namespace Modules\Product\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Brand\Contracts\BrandRepositoryInterface;
use Modules\Category\Contracts\CategoryRepositoryInterface;
use Modules\Core\Responses\AjaxResponse;
use Modules\Product\Contracts\ProductRepositoryInterface;
use Modules\Product\Http\Requests\StoreProductRequest;
use Modules\Product\Http\Requests\UpdateProductRequest;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductImage;
use Modules\Core\Services\ImageService;
class ProductController extends Controller
{
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepo = $productRepository;
    }

    public function index()
    {
        $this->authorize('view' , Product::class );
        $products = $this->productRepo->getAll();
        return view('Product::index', compact('products'));
    }

    public function create()
    {
        $this->authorize('manage' , Product::class );
        $brands = (resolve(BrandRepositoryInterface::class))->getActive();
        $categories = (resolve(CategoryRepositoryInterface::class))->getActive();
        return view('Product::create', compact('brands', 'categories'));
    }

    public function store(StoreProductRequest $request)
    {
        $this->authorize('manage' , Product::class);
        $data = $request->all();
        $product = $this->productRepo->store($data);

        //store primary color
        $this->productRepo->storeColor($product->id , [
            "color_name" => $request->color_name,
            "color_value" => $request->color_value,
            "quantity" => $request->quantity,
            "price_increase" => 0] ,
            true);

        //upload primary image
        $imageName = ImageService::uploadImage($request->primary_image, 'product' , $product->getUploadDirectory());
        $this->productRepo->storeProductImage($imageName, $product->id, ProductImage::IS_PRIMARY_TRUE);
        //other images
        if ($request->hasFile('images')) {
            $images = $request->images;
            foreach ($images as $image) {
                $imageName = ImageService::uploadImage($image, 'product' , $product->getUploadDirectory());
                $this->productRepo->storeProductImage($imageName, $product->id, ProductImage::IS_PRIMARY_FALSE);
            }
        }
        newFeedback();
        return redirect()->route('panel.products.index');
    }

    public function edit($productId)
    {
        $this->authorize('manage' , Product::class);
        $product = $this->productRepo->findByIdWithRelations($productId);
        $productColor = $this->productRepo->findDefaultProductColor($product);
        $brands = (resolve(BrandRepositoryInterface::class))->getActive();
        $categories = (resolve(CategoryRepositoryInterface::class))->getActive();
        return view('Product::edit', compact('product', 'brands', 'categories' , 'productColor'));
    }

    public function update(UpdateProductRequest $request, $productId)
    {
        $this->authorize('manage' , Product::class);
        $product = $this->productRepo->findById($productId);
        $data = $request->all();

        //update product
        $product = $this->productRepo->update($productId, $data);

        //update primary color
        $this->productRepo->updateColor($product->id , $request->color_id ,[
            "color_name" => $request->color_name,
            "color_value" => $request->color_value,
            "quantity" => $request->quantity,
            "price_increase" => 0] ,
            true);

        //upload primary image
        if ($request->hasFile('primary_image')) {
            //delete old image
            if (!is_null($product->primaryImage)) {
                ImageService::deleteImage($product->primaryImage->images,$product->getUploadDirectory());
                $this->productRepo->deleteImageById($product->id ,$product->primaryImage->id,);
            }
            //upload new image
            $imageName = ImageService::uploadImage($request->primary_image, 'product' , $product->getUploadDirectory());
            $this->productRepo->storeProductImage($imageName, $product->id, ProductImage::IS_PRIMARY_TRUE);
        }

        //other images
        if ($request->hasFile('images')) {
            $images = $request->images;
            foreach ($images as $image) {
                $imageName = ImageService::uploadImage($image, 'product' , $product->getUploadDirectory());
                $this->productRepo->storeProductImage($imageName, $product->id, ProductImage::IS_PRIMARY_FALSE);
            }
        }
        newFeedback();
        return redirect()->route('panel.products.index');
    }

    public function destroy($productId)
    {
        $this->authorize('manage' , Product::class);
        $product = $this->productRepo->findById($productId);
        $this->productRepo->destroy($productId);
        return AjaxResponse::success();
    }
}
