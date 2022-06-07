<?php

namespace Modules\Front\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Product\Contracts\ProductRepositoryInterface;

class HomeController extends Controller
{
    public function index()
    {
        $products = resolve(ProductRepositoryInterface::class)->getSelectedProducts();
        return view('Front::index' , compact('products'));
    }


}
