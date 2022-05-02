<?php

namespace Modules\Brand\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Brand\Contracts\brandRepositoryInterface;
use Modules\Brand\Http\Requests\BrandRequest;

class BrandController extends Controller
{
    private $brandRepo;
    public function __construct(brandRepositoryInterface $brandRepo)
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
            return response()->json([
                'message' => 'برندی با این شناسه پیدا نشد!' ,
                'status' => -1
            ]);
        }
        $this->brandRepo->destroy($brandId);
        return response()->json([
            'message' => "برند ".$brand->name." با موفقیت حذف شد." ,
            'status' => 1
        ]);
    }

}
