<?php

namespace Modules\Front\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Product\Services\ImageService;

class ImageController extends Controller
{
    public function show($dir,$imageName)
    {
        return ImageService::loadImage($imageName , $dir);
    }
}
