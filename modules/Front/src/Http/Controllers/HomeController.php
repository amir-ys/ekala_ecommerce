<?php

namespace Modules\Front\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Blog\Contracts\PostRepositoryInterface;
use Modules\Product\Contracts\ProductRepositoryInterface;
use Modules\Slide\Contracts\SlideRepositoryInterface;

class HomeController extends Controller
{
    public function index()
    {
        $bottomBanners  = resolve(SlideRepositoryInterface::class)->getBottomPageBanners();
        $topBanners = resolve(SlideRepositoryInterface::class)->getTopPageBanners();
        $sliders = resolve(SlideRepositoryInterface::class)->getSliders();
        $products = resolve(ProductRepositoryInterface::class)->getLatest();
        $productWithDiscount = resolve(ProductRepositoryInterface::class)->getDiscounted();
        $bestSellingProducts = resolve(ProductRepositoryInterface::class)->getBestSelling();
        $posts = resolve(PostRepositoryInterface::class)->getLatest();
        return view('Front::index' , compact('products' , 'sliders' ,
            'bottomBanners' ,'topBanners' , 'productWithDiscount' , 'posts' , 'bestSellingProducts'));
    }


}
