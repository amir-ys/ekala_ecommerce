<?php
namespace  Modules\Product\Http\Controllers;
use App\Http\Controllers\Controller;
use Modules\Brand\Contracts\BrandRepositoryInterface;
use Modules\Category\Contracts\CategoryRepositoryInterface;
use Modules\Product\Contracts\ProductRepositoryInterface;
use Modules\Product\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepo = $productRepository;
    }
    public function index()
    {
        $products = $this->productRepo->getAll();
        return view('Product::index' , compact('products'));
    }

    public function create()
    {
        $brands = (resolve(BrandRepositoryInterface::class))->all();
        $categories = (resolve(CategoryRepositoryInterface::class))->all();
        return view('Product::create' , compact('brands' , 'categories'));
    }

    public function store(ProductRequest $request)
    {
        $this->productRepo->store($request->all());
        newFeedback();
        return redirect()->route('panel.products.index');
    }
}
