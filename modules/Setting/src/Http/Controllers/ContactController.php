<?php

namespace Modules\Setting\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Setting\Contracts\SettingRepositoryInterface;

class ContactController extends Controller
{
    private $settingRepo;
    public function __construct(SettingRepositoryInterface $settingRepo)
    {
        $this->settingRepo = $settingRepo;
    }
    public function index()
    {
        $settings = [];
        return view('Setting::contact-us.index' ,  compact('settings'));
    }

    public function savePage()
    {
        $contact = $this->settingRepo->getContact();
        return view('Setting::contact-us.save'  ,compact('contact'));
    }

    public function save(Request $request)
    {
        $this->settingRepo->storeContact($request->all());
        newFeedback();
        return back();
    }
}
