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
        return to_route('panel.brands.index');
    }

    public function destroy($brandId)
    {
        $brand = Brand::query()->findOrFail($brandId);
        $brand->delete();
      return back();
    }

}
