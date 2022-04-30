<?php

namespace Modules\Brand\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Brand\Http\Requests\BrandRequest;
use Modules\Brand\Models\Brand;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::query()->latest()->paginate();
        return view('Brand::index' , compact('brands'));
    }

    public function store(BrandRequest $request)
    {
        Brand::create([
            'name' => $request->name ,
            'is_active' => $request->is_active
        ]);
        return back();
    }

    public function edit($brandId)
    {
        $brand = Brand::query()->findOrFail($brandId);
        return view('Brand::edit' , compact('brand'));
    }

    public function update(BrandRequest $request , $brandId)
    {
        $brand = Brand::query()->findOrFail($brandId);
        $brand->update([
            'name' => $request->name ,
            'is_active' => $request->is_active
        ]);
        newFeedback();
        return to_route('panel.brands.index');
    }

    public function destroy($brandId)
    {
        $brand = Brand::query()->find($brandId);
        if (!$brand){
            return response()->json([
                'message' => 'برندی با این شناسه پیدا نشد!' ,
                'status' => -1
            ]);
        }
        $brand->delete();
        return response()->json([
            'message' => "برند ".$brand->name." با موفقیت حذف شد." ,
            'status' => 1
        ]);
    }

}
