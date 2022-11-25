<?php

namespace Modules\Front\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Core\Services\ImageService;
use Modules\Slide\Contracts\SlideRepositoryInterface;
use Modules\Slide\Models\Slide;

class ImageController extends Controller
{
    public function showSlideImage($slideId)
    {
        $slide = resolve(SlideRepositoryInterface::class)->findById($slideId);
        return ImageService::loadImage($slide->image['large'] , Slide::getUploadDir());    }
}
