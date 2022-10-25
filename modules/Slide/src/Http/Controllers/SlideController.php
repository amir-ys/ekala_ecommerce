<?php

namespace Modules\Slide\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Core\Responses\AjaxResponse;
use Modules\Product\Services\ImageService;
use Modules\Slide\Contracts\SlideRepositoryInterface;
use Modules\Slide\Http\Requests\SlideRequest;
use Modules\Slide\Models\Slide;

class SlideController extends Controller
{
    private $slideRepo;
    public function __construct(SlideRepositoryInterface $slideRepo)
    {
        $this->slideRepo = $slideRepo;
    }
    public function index()
    {
        $this->authorize('view' , Slide::class);
        $slides = $this->slideRepo->getAll();
        return view('Slide::index' ,compact('slides'));
    }

    public function create()
    {
        $this->authorize('manage' , Slide::class);
        return view('Slide::create');
    }

    public function store(SlideRequest $request)
    {
        $this->authorize('manage' , Slide::class);
        $request->request->add(['image_name' => $this->uploadImage($request->file('image') ,$request->type )]);
        $this->slideRepo->store($request->all());
        newFeedback();
        return to_route('panel.slides.index');
    }

    public function edit($slideId)
    {
        $this->authorize('manage' , Slide::class);
        $slide = $this->slideRepo->findById($slideId);
        return view('Slide::edit' , compact('slide'));
    }

    public function update(SlideRequest $request , $slideId)
    {
        $this->authorize('manage' , Slide::class);
        $slide = $this->slideRepo->findById($slideId);
        $request->request->add(['image_name' => $this->uploadImage($request->file('image') , $request->type , $slide)]);

        $this->slideRepo->update($slideId , $request->all());
        newFeedback();
        return to_route('panel.slides.index');
    }

    public function destroy($slideId)
    {
        $this->authorize('manage' , Slide::class);
        $slide = $this->slideRepo->findById($slideId);
        $this->slideRepo->destroy($slideId);
        return AjaxResponse::success("اسلایدر  ". $slide->title." با موفقیت حذف شد.");
    }

    public function showImage($slideId)
    {
        $this->authorize('view' , Slide::class);
        $slide = $this->slideRepo->findById($slideId);
        return ImageService::loadImage($slide->image['large'] , Slide::getUploadDir());
    }

    private function uploadImage($file, $type , $slide = null)
    {
        $type  = "slide." . $type;
        if ($file) {

            if ($slide && !is_null($slide->image)){
                $this->deleteImage($slide->image);
            }

            return ImageService::uploadImage($file, $type ,  Slide::getUploadDir());
        }
        return $slide->image;

    }

    private function deleteImage($fileNames)
    {
        ImageService::deleteImage($fileNames, Slide::getUploadDir());
    }
}
