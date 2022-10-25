<?php

namespace Modules\Product\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Core\Responses\AjaxResponse;
use Modules\Product\Contracts\ProductRepositoryInterface;
use Modules\Product\Http\Requests\ProductColorRequest;
use Modules\Product\Models\Product;

class ProductColorController extends Controller
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
        $colors = $this->productRepo->getProductColors($productId);
        return view('Product::product-colors.index', compact('colors', 'product'));
    }

    public function create($productId)
    {
        $this->authorize('manage', Product::class);
        $product = $this->productRepo->findById($productId);
        return view('Product::product-colors.create', compact('product'));
    }

    public function store(ProductColorRequest $request, $productId)
    {
        $this->authorize('manage', Product::class);
        $this->productRepo->storeColor($productId, $request->all(), isset($request->is_primary));
        newFeedback();
        return redirect()->route('panel.products.colors.index', $productId);
    }

    public function edit($productId, $colorId)
    {
        $this->authorize('manage', Product::class);
        $product = $this->productRepo->findById($productId);
        $color = $this->productRepo->findColorById($productId, $colorId);
        return view('Product::product-colors.edit', compact('color', 'product'));
    }

    public function update(ProductColorRequest $request, $productId, $colorId)
    {
        $this->authorize('manage', Product::class);
        $this->productRepo->updateColor($productId, $colorId, $request->all(), isset($request->is_primary));
        newFeedback();
        return redirect()->route('panel.products.colors.index', $productId);
    }

    public function destroy($productId, $colorId)
    {
        $this->authorize('manage', Product::class);
        $this->productRepo->destroyColor($productId, $colorId);
        return AjaxResponse::success();
    }
}
