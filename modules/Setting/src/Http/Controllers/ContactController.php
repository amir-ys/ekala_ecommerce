<?php

namespace Modules\Setting\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Setting\Contracts\ContactRepositoryInterface;
use Modules\Setting\Contracts\SettingRepositoryInterface;
use Modules\Setting\Http\Requests\SaveContactMessageRequest;
use Modules\Setting\Models\Setting;

class ContactController extends Controller
{
    private $settingRepo;

    public function __construct(SettingRepositoryInterface $settingRepo)
    {
        $this->settingRepo = $settingRepo;
    }
    public function index()
    {
        $this->authorize('view' , Setting::class);
        $messages = resolve(ContactRepositoryInterface::class)->getMessage();
        return view('Setting::contact-us.index' ,  compact('messages'));
    }

    public function show($contactId)
    {
        $this->authorize('view' , Setting::class);
        $contact = resolve(ContactRepositoryInterface::class)->findById($contactId);
        resolve(ContactRepositoryInterface::class)->changeReadAt($contactId);
        return view('Setting::contact-us.show' , compact('contact'));
    }

    public function saveInfoPage()
    {
        $this->authorize('manage' , Setting::class);
        $contact = $this->settingRepo->getContact();
        return view('Setting::contact-us.save'  ,compact('contact'));
    }

    public function saveInfo(Request $request)
    {
        $this->authorize('manage' , Setting::class);
        $this->settingRepo->storeContact($request->all());
        newFeedback();
        return back();
    }

    public function saveContactMessage(SaveContactMessageRequest $request)
    {
        resolve(ContactRepositoryInterface::class)->store($request->all());
        alert()->success('موفق آمیز' , 'پیام شما با موفقیت ارسال شد. بزودی با شما تماس گرفته می شود.');
        return back();
    }
}
