<?php

namespace Modules\Dashboard\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\User\Contracts\UserRepositoryInterface;

class DashboardController extends Controller
{
    public function index(UserRepositoryInterface $userRepo)
    {
        if (!auth()->user()->isAdmin()) {
            return abort(403);
        }

        $totalUserCount = $userRepo->getTotalUserCount();
        $getTodayRegisteredUsersCount = $userRepo->getTodayRegisteredUsersCount();
        $getThisMonthReqisteredUsersCount = $userRepo->getThisMonthReqisteredUsersCount();
        $getAdminCount = $userRepo->getTotalAdminCount();

        return view('Dashboard::index', compact('totalUserCount', 'getTodayRegisteredUsersCount',
            'getThisMonthReqisteredUsersCount', 'getAdminCount'));
    }
}
