<?php

namespace Modules\Setting\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Setting\Contracts\ContactRepositoryInterface;
use Modules\Setting\Contracts\SettingRepositoryInterface;
use Modules\Setting\Http\Requests\SaveContactMessageRequest;
use function GuzzleHttp\Promise\all;

class ContactController extends Controller
{
    private $settingRepo;

    public function __construct(SettingRepositoryInterface $settingRepo)
    {
        $this->settingRepo = $settingRepo;
    }
    public function index()
    {
        $messages = resolve(ContactRepositoryInterface::class)->getMessage();
        return view('Setting::contact-us.index' ,  compact('messages'));
    }

    public function show($contactId)
    {
        $contact = resolve(ContactRepositoryInterface::class)->findById($contactId);
        resolve(ContactRepositoryInterface::class)->changeReadAt($contactId);
        return view('Setting::contact-us.show' , compact('contact'));
    }

    public function saveInfoPage()
    {
        $contact = $this->settingRepo->getContact();
        return view('Setting::contact-us.save'  ,compact('contact'));
    }

    public function saveInfo(Request $request)
    {
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
