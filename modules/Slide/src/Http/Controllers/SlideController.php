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
        $slides = $this->slideRepo->getAll();
        return view('Slide::index' ,compact('slides'));
    }

    public function create()
    {
        return view('Slide::create');
    }

    public function store(SlideRequest $request)
    {
        $request->request->add(['image_name' => ImageService::uploadImage($request->photo , Slide::getUploadDir())]);
        $this->slideRepo->store($request->all());
        newFeedback();
        return to_route('panel.slides.index');
    }

    public function edit($slideId)
    {
        $slide = $this->slideRepo->findById($slideId);
        return view('Slide::edit' , compact('slide'));
    }

    public function update(SlideRequest $request , $slideId)
    {
        $slide = $this->slideRepo->findById($slideId);
        if ($request->hasFile('photo')){
            ImageService::deleteImage($slide->name , Slide::getUploadDir());
            $request->request->add(['image_name' => ImageService::uploadImage($request->photo , Slide::getUploadDir())]);
        }else{
            $request->request->add(['image_name' => $slide->photo  ]);
        }
        $this->slideRepo->update($slideId , $request->all());
        newFeedback();
        return to_route('panel.slides.index');
    }

    public function destroy($slideId)
    {
        $slide = $this->slideRepo->findById($slideId);
        ImageService::deleteImage($slide->name , Slide::getUploadDir());
        $this->slideRepo->destroy($slideId);
        return AjaxResponse::success("اسلایدر  ". $slide->title." با موفقیت حذف شد.");
    }

    public function showImage($name)
    {
        return ImageService::loadImage($name , Slide::getUploadDir());
    }
}
