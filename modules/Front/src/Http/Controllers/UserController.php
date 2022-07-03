<?php

namespace Modules\Front\Http\Controllers;

use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function personalInfo()
    {
        return view('Front::user-profile.personal-info');
    }

    public function wishlists()
    {
        return view('Front::user-profile.wishlists');
    }

    public function orders()
    {
        return view('Front::user-profile.orders');
    }

    public function addresses()
    {
        return view('Front::user-profile.addresses');
    }
}
