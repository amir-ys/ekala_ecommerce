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
        $this->CouponRepo = $couponRepo;
    }

    public function index()
    {
        $coupons = $this->CouponRepo->getAll();
        return view('Coupon::index', compact('coupons'));
    }

    public function create()
    {
        return view('Coupon::create');
    }

    public function store(CouponRequest $request)
    {
        $this->CouponRepo->store($request->all());
        newFeedback();
        return to_route('panel.coupons.index');
    }

    public function edit($couponId)
    {
        $coupon = $this->CouponRepo->findById($couponId);
        return view('Coupon::edit', compact('coupon'));
    }

    public function update(CouponRequest $request, $couponId)
    {
        $this->CouponRepo->update($couponId, $request->all());
        newFeedback();
        return to_route('panel.coupons.index');
    }

    public function destroy($couponId)
    {
        $coupon = $this->CouponRepo->findById($couponId);

        $this->CouponRepo->destroy($couponId);
        return AjaxResponse::success("کوین " . $coupon->name . " با موفقیت حذف شد.");
    }
}
