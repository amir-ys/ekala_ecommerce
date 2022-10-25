<?php

namespace Modules\Coupon\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Core\Responses\AjaxResponse;
use Modules\Coupon\Contracts\CouponRepositoryInterface;
use Modules\Coupon\Http\Requests\CouponRequest;
use Modules\Coupon\Models\Coupon;
use Modules\Coupon\Repositories\CouponRepo;
use Modules\User\Contracts\UserRepositoryInterface;

class CouponController extends Controller
{
    private CouponRepo $couponRepo;

    public function __construct(CouponRepositoryInterface $couponRepo)
    {
        $this->couponRepo = $couponRepo;
    }

    public function index()
    {
        $this->authorize('view' , Coupon::class);
        $coupons = $this->couponRepo->getAll();
        return view('Coupon::coupons.index', compact('coupons'));
    }

    public function create(UserRepositoryInterface $userRepo)
    {
        $this->authorize('manage' , Coupon::class);
        $users = $userRepo->getAll();
        return view('Coupon::coupons.create' , compact('users'));
    }

    public function store(CouponRequest $request)
    {
        $this->authorize('manage' , Coupon::class);
        $data = $request->all();
        $data['start_date'] = convertJalaliToDate($request->start_date , 'Y/m/d H:i' );
        $data['end_date'] = convertJalaliToDate($request->end_date , 'Y/m/d H:i' );

        $this->couponRepo->store($data);
        newFeedback();
        return to_route('panel.coupons.index');
    }

    public function edit($couponId , UserRepositoryInterface $userRepo)
    {
        $this->authorize('manage' , Coupon::class);
        $users = $userRepo->getAll();
        $coupon = $this->couponRepo->findById($couponId);
        return view('Coupon::coupons.edit', compact('coupon' , 'users'));
    }

    public function update(CouponRequest $request, $couponId)
    {
        $this->authorize('manage' , Coupon::class);
        $data = $request->all();
        $data['start_date'] = convertJalaliToDate($request->start_date , 'Y/m/d H:i' );
        $data['end_date'] = convertJalaliToDate($request->end_date , 'Y/m/d H:i' );

        $this->couponRepo->update($couponId,$data);
        newFeedback();
        return to_route('panel.coupons.index');
    }

    public function destroy($couponId)
    {
        $this->authorize('manage' , Coupon::class);
        $coupon = $this->couponRepo->findById($couponId);

        $this->couponRepo->destroy($couponId);
        return AjaxResponse::success("کوین " . $coupon->name . " با موفقیت حذف شد.");
    }
}
