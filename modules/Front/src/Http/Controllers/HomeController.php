<?php

namespace Modules\Front\Http\Controllers;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view('Front::index');
    }

}
