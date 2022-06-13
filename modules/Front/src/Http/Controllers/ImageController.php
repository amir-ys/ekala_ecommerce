<?php

namespace Modules\Front\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Product\Contracts\ProductRepositoryInterface;
use Modules\Product\Services\ImageService;
use Modules\Slide\Contracts\SlideRepositoryInterface;

class ImageController extends Controller
{
    public function show($dir,$imageName)
    {
        return ImageService::loadImage($imageName , $dir);
    }
}
