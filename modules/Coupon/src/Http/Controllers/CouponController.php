<?php

namespace Modules\Coupon\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Core\Responses\AjaxResponse;
use Modules\Coupon\Contracts\CouponRepositoryInterface;
use Modules\Coupon\Http\Requests\CouponRequest;
use Modules\Coupon\Repositories\CouponRepo;

class CouponController extends Controller
{
    private CouponRepo $couponRepo;

    public function __construct(CouponRepositoryInterface $couponRepo)
    {
        $this->couponRepo = $couponRepo;
    }

    public function index()
    {
        $coupons = $this->couponRepo->getAll();
        return view('Coupon::index', compact('coupons'));
    }

    public function create()
    {
        return view('Coupon::create');
    }

    public function store(CouponRequest $request)
    {
        $this->couponRepo->store($request->all());
        newFeedback();
        return to_route('panel.coupons.index');
    }

    public function edit($couponId)
    {
        $coupon = $this->couponRepo->findById($couponId);
        return view('Coupon::edit', compact('coupon'));
    }

    public function update(CouponRequest $request, $couponId)
    {
        $this->couponRepo->update($couponId, $request->all());
        newFeedback();
        return to_route('panel.coupons.index');
    }

    public function destroy($couponId)
    {
        $coupon = $this->couponRepo->findById($couponId);

        $this->couponRepo->destroy($couponId);
        return AjaxResponse::success("کوین " . $coupon->name . " با موفقیت حذف شد.");
    }
}
