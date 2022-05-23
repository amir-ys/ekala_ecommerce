<?php
namespace  Modules\Product\Http\Controllers;
use App\Http\Controllers\Controller;
use Modules\Brand\Models\Brand;
use Modules\Category\Models\Category;
use Modules\Product\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::query()->latest()->paginate();
        return view('Product::index' , compact('products'));
    }
}
