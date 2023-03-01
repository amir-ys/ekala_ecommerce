<?php

namespace Modules\Dashboard\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Payment\Contracts\PaymentRepositoryInterface;
use Modules\User\Contracts\UserRepositoryInterface;

class DashboardController extends Controller
{
    public function index(UserRepositoryInterface $userRepo , PaymentRepositoryInterface $paymentRepo)
    {
        if (!auth()->user()->isAdmin()) {
            return abort(403);
        }

        $totalUserCount = $userRepo->getTotalUserCount();
        $getTodayRegisteredUsersCount = $userRepo->getTodayRegisteredUsersCount();
        $getThisMonthReqisteredUsersCount = $userRepo->getThisMonthReqisteredUsersCount();
        $getAdminCount = $userRepo->getTotalAdminCount();

        $totalSalesForCurrentDay = $paymentRepo->totalSalesForCurrentDay();
        $totalSalesInThisYear = $paymentRepo->totalSalesInThisYear();
        $totalSalesInThisMonth = $paymentRepo->totalSalesInThisMonth();

        return view('Dashboard::index', compact('totalUserCount', 'getTodayRegisteredUsersCount',
            'totalSalesInThisYear' ,'totalSalesInThisMonth' ,
            'getThisMonthReqisteredUsersCount', 'getAdminCount' ,   'totalSalesForCurrentDay'));
    }
}
