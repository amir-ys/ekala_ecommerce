<?php

namespace Modules\Front\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Product\Contracts\ProductRepositoryInterface;
use Modules\Setting\Contracts\SettingRepositoryInterface;
use Modules\Slide\Contracts\SlideRepositoryInterface;

class SiteInfoController extends Controller
{
    private SettingRepositoryInterface $settingRepo;

    public function __construct(SettingRepositoryInterface $settingRepo)
    {
        $this->settingRepo = $settingRepo;
    }
    public function showAboutPage()
    {
        $about = $this->settingRepo->getAbout();
        return view('Front::about-us.index' , compact('about'));
    }

    public function showContactPage()
    {
        $contact = $this->settingRepo->getContact();
        return view('Front::contact-us.index' , compact('contact'));
    }
}
