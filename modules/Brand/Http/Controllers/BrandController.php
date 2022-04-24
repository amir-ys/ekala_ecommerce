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
            'slug' => str()->slug($request->name) ,
            'is_active' => $request->is_active
        ]);
        return back();
    }

}
