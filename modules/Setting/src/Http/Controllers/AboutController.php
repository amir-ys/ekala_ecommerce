<?php

namespace Modules\Setting\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Core\Services\ImageService;
use Modules\Setting\Contracts\SettingRepositoryInterface;
use Modules\Setting\Http\Requests\AboutRequest;
use Modules\Setting\Models\Setting;

class AboutController extends Controller
{
    private $settingRepo;
    public function __construct(SettingRepositoryInterface $settingRepo)
    {
        $this->settingRepo = $settingRepo;
    }
    public function aboutPage()
    {
        $this->authorize('manage' , Setting::class);
        $about = $this->settingRepo->getAbout();
        return view('Setting::about-us.show', compact('about'));
    }

    public function storeAbout(AboutRequest $request)
    {
        $this->authorize('manage' , Setting::class);
        $this->uploadAboutImage($request);
        $this->settingRepo->storeAbout($request->all());
        newFeedback();
        return back();
    }

    private function uploadAboutImage($request)
    {
        $oldImage = $this->settingRepo->getAbout() ? $this->settingRepo->getAbout()->json['photo'] : null;
        if ($request->hasFile('photo')) {
            $oldImage ? ImageService::deleteImage($oldImage, Setting::getAboutUsDir()) : null;
            $request->request->add(['photo_uploaded' => ImageService::uploadImage($request->file('photo'), 'settings' ,
                Setting::getAboutUsDir(), 'about-us')]);
        } else {
            $request->request->add(['photo_uploaded' => $oldImage]);
        }
    }

    public function showAboutImage($name)
    {
        return ImageService::loadImage($name, Setting::getAboutUsDir());
    }
}
