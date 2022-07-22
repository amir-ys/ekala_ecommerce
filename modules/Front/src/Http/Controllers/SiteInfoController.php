<?php

namespace Modules\Front\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Setting\Contracts\FaqRepositoryInterface;
use Modules\Setting\Contracts\SettingRepositoryInterface;

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

    public function showFaqPage()
    {
        $faqs = (resolve(FaqRepositoryInterface::class))->getPublishedFaqs();
        return view('Front::faqs.index' , compact('faqs'));
    }
}
