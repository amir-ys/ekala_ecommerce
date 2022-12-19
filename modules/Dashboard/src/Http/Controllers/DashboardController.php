<?php

namespace Modules\Dashboard\Http\Controllers;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        if (!auth()->user()->isAdmin()){
            return  abort(403);
        }
        return view('Dashboard::index');
    }
}
