<?php

namespace Modules\Front\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\User\Contracts\UserRepositoryInterface;

class UserController extends Controller
{
    private UserRepositoryInterface $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }
    public function personalInfo()
    {
        return view('Front::user-profile.personal-info');
    }

    public function wishlists()
    {
        return view('Front::user-profile.wishlists');
    }

    public function orders(Request $request)
    {
        $orders = $this->userRepo->getUserOrders(auth()->id() , $request->status);
        return view('Front::user-profile.orders' , compact('orders'));
    }

    public function addresses()
    {
        return view('Front::user-profile.addresses');
    }
}
