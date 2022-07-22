<?php

namespace Modules\Setting\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Setting\Contracts\FaqRepositoryInterface;
use Modules\Setting\Http\Requests\FaqRequest;

class FaqController extends Controller
{
    private $faqRepo;

    public function __construct(FaqRepositoryInterface $faqRepo)
    {
        $this->faqRepo = $faqRepo;
    }
    public function index()
    {
        $faqs = $this->faqRepo->getAll();
        return view('Setting::faqs.index' ,  compact('faqs'));
    }

    public function create()
    {
        return view('Setting::faqs.create');
    }

    public function store(FaqRequest $request)
    {
        $this->faqRepo->store($request->all());
        newFeedback();
        return redirect()->route('panel.settings.faqs.index');
    }

    public function edit($faqId)
    {
       $faq =  $this->faqRepo->findById($faqId);
        return view('Setting::faqs.edit' , compact('faq'));
    }

    public function update(FaqRequest $request , $faqId )
    {
        $this->faqRepo->update($faqId , $request->all());
        newFeedback();
        return redirect()->route('panel.settings.faqs.index');
    }

    public function destroy($faqId)
    {
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
