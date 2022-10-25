<?php

namespace Modules\Product\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Core\Responses\AjaxResponse;
use Modules\Product\Contracts\ProductRepositoryInterface;
use Modules\Product\Http\Requests\ProductWarrantyRequest;
use Modules\Product\Models\Product;

class ProductWarrantyController extends Controller
{
    private $productRepo;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepo = $productRepository;
    }

    public function index($productId)
    {
        $this->authorize('view', Product::class);
        $product = $this->productRepo->findById($productId);
        $warranties = $this->productRepo->getProductWarranties($productId);
        return view('Product::warranties.index', compact('warranties', 'product'));
    }

    public function create($productId)
    {
        $this->authorize('manage', Product::class);
        $product = $this->productRepo->findById($productId);
        return view('Product::warranties.create', compact('product'));
    }

    public function store(ProductWarrantyRequest $request, $productId)
    {
        $this->authorize('manage', Product::class);
        $this->productRepo->storeWarranty($productId, $request->all());
        newFeedback();
        return redirect()->route('panel.products.warranties.index', $productId);
    }

    public function edit($productId, $warrantyId)
    {
        $this->authorize('manage', Product::class);
        $product = $this->productRepo->findById($productId);
        $warranty = $this->productRepo->findWarrantyById($productId, $warrantyId);
        return view('Product::warranties.edit', compact('warranty', 'product'));
    }

    public function update(ProductWarrantyRequest $request, $productId, $warrantyId)
    {
        $this->authorize('manage', Product::class);
        $this->productRepo->updateWarranty($productId, $warrantyId, $request->all());
        newFeedback();
        return redirect()->route('panel.products.warranties.index', $productId);
    }

    public function destroy($productId, $warrantyId)
    {
        $this->authorize('manage', Product::class);
        $this->productRepo->destroyWarranty($productId, $warrantyId);
        return AjaxResponse::success();
    }
}
