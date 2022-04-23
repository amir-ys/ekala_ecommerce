<?php

namespace Modules\Brand\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Brand\Models\Brand;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::query()->latest()->paginate();
        return view('Brand::index' , compact('brands'));
    }

}
