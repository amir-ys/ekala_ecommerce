<?php

namespace Modules\Front\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Product\Contracts\ProductRepositoryInterface;
use Modules\Slide\Contracts\SlideRepositoryInterface;

class HomeController extends Controller
{
    public function index()
    {
        $bottomBanners  = resolve(SlideRepositoryInterface::class)->getBottomPageBanners();
        $topBanners = resolve(SlideRepositoryInterface::class)->getTopPageBanners();
        $sliders = resolve(SlideRepositoryInterface::class)->getSliders();
        $products = resolve(ProductRepositoryInterface::class)->getSelectedProducts();
        return view('Front::index' , compact('products' , 'sliders' , 'bottomBanners' ,'topBanners'));
    }


}
