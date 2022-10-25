<?php

namespace Modules\Setting\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Setting\Contracts\FaqRepositoryInterface;
use Modules\Setting\Http\Requests\FaqRequest;
use Modules\Setting\Models\Setting;

class FaqController extends Controller
{
    private $faqRepo;

    public function __construct(FaqRepositoryInterface $faqRepo)
    {
        $this->faqRepo = $faqRepo;
    }
    public function index()
    {
        $this->authorize('view' , Setting::class);
        $faqs = $this->faqRepo->getAll();
        return view('Setting::faqs.index' ,  compact('faqs'));
    }

    public function create()
    {
        $this->authorize('manage' , Setting::class);
        return view('Setting::faqs.create');
    }

    public function store(FaqRequest $request)
    {
        $this->authorize('manage' , Setting::class);

        $this->faqRepo->store($request->all());
        newFeedback();
        return redirect()->route('panel.settings.faqs.index');
    }

    public function edit($faqId)
    {
        $this->authorize('manage' , Setting::class);
        $faq =  $this->faqRepo->findById($faqId);
        return view('Setting::faqs.edit' , compact('faq'));
    }

    public function update(FaqRequest $request , $faqId )
    {
        $this->authorize('manage' , Setting::class);
        $this->faqRepo->update($faqId , $request->all());
        newFeedback();
        return redirect()->route('panel.settings.faqs.index');
    }

    public function destroy($faqId)
    {
        $this->authorize('manage' , Setting::class);
        $faq =  $this->faqRepo->findById($faqId);
        if (!$faq){
            newFeedback('ناموفق'  , 'مدل پیدا نشد.'  , 'error');
            return back();
        }
        $this->faqRepo->destroy($faqId);
        newFeedback();
        return back();
    }
}
