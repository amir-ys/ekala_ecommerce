<?php

namespace Modules\Setting\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Setting\Contracts\SettingRepositoryInterface;
use Modules\Setting\Models\Setting;

class SettingController extends Controller
{
    private $settingRepo;
    public function __construct(SettingRepositoryInterface $settingRepo)
    {
        $this->settingRepo = $settingRepo;
    }
    public function index()
    {
        $shopName = $this->settingRepo->getItem(Setting::SETTING_SHOP_NAME);
        $shopFooter = $this->settingRepo->getItem(Setting::SETTING_SHOP_FOOTER);
        $shopFooterContact = $this->settingRepo->getItem(Setting::SETTING_SHOP_FOOTER_CONTACT);
        $socialMedia = $this->settingRepo->getItem(Setting::SETTING_SOCIAL_MEDIA);
        return view('Setting::index' , compact('shopName' , 'shopFooter' , 'shopFooterContact' , 'socialMedia' ));
    }

    public function siteInfoStore(Request $request)
    {
        $this->settingRepo->storeSiteInfo($request->all());
        newFeedback();
        return back();
    }

    public function socialMediaStore(Request $request)
    {
        $this->settingRepo->storeSocialMedia($request->all());
        newFeedback();
        return back();
    }
}
