<?php

namespace Modules\Brand\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Brand\Contracts\BrandRepositoryInterface;
use Modules\Brand\Http\Requests\BrandRequest;
use Modules\Core\Responses\AjaxResponse;

class BrandController extends Controller
{
    private $brandRepo;
    public function __construct(BrandRepositoryInterface $brandRepo)
    {
        $this->brandRepo = $brandRepo;
    }
    public function index()
    {
        $brands = $this->brandRepo->getAllPaginate();
        return view('Brand::index' , compact('brands'));
    }

    public function store(BrandRequest $request)
    {
        $this->brandRepo->store($request->all());
        newFeedback();
        return back();
    }

    public function edit($brandId)
    {
        $brand = $this->brandRepo->findById($brandId);
        return view('Brand::edit' , compact('brand'));
    }

    public function update(BrandRequest $request , $brandId)
    {
       $this->brandRepo->update($brandId , $request->all());
        newFeedback();
        return to_route('panel.brands.index');
    }

    public function destroy($brandId)
    {
        $brand = $this->brandRepo->findById($brandId);
        if (!$brand){
           return AjaxResponse::error('برندی با این شناسه پیدا نشد.');
        }
        $this->brandRepo->destroy($brandId);
        return AjaxResponse::success("برند ".$brand->name." با موفقیت حذف شد.");
    }

}
