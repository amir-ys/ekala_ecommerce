<?php

namespace Modules\Category\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Category\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::query()->latest()->paginate();
        return view('Category::index' , compact('categories'));
    }

    public function create()
    {
        return view('Category::create');
    }

}
