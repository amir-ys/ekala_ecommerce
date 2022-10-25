<?php

namespace Modules\Coupon\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Core\Responses\AjaxResponse;
use Modules\Coupon\Contracts\CommonDiscountRepositoryInterface;
use Modules\Coupon\Http\Requests\CommonDiscountRequest;
use Modules\Coupon\Models\Coupon;


class CommonDiscountController extends Controller
{
    private CommonDiscountRepositoryInterface $commonDiscountRepo;

    public function __construct(CommonDiscountRepositoryInterface $commonDiscountRepo)
    {
        $this->commonDiscountRepo = $commonDiscountRepo;
    }

    public function index()
    {
        $this->authorize('view' , Coupon::class);
        $discounts = $this->commonDiscountRepo->getAll();
        return view('Discount::common-discounts.index', compact('discounts'));
    }

    public function create()
    {
        $this->authorize('manage' , Coupon::class);
        return view('Discount::common-discounts.create');
    }

    public function store(CommonDiscountRequest $request)
    {
        $this->authorize('manage' , Coupon::class);
        $data = $request->all();
        $data['start_date'] = convertJalaliToDate($request->start_date , 'Y/m/d H:i' );
        $data['end_date'] = convertJalaliToDate($request->end_date , 'Y/m/d H:i' );


        $this->commonDiscountRepo->store($data);
        newFeedback();
        return to_route('panel.commonDiscounts.index');
    }

    public function edit($discountId)
    {
        $this->authorize('manage' , Coupon::class);
        $discount = $this->commonDiscountRepo->findById($discountId);
        return view('Discount::common-discounts.edit', compact('discount'));
    }

    public function update(CommonDiscountRequest $request, $discountId)
    {
        $this->authorize('manage' , Coupon::class);
        $data = $request->all();
        $data['start_date'] = convertJalaliToDate($request->start_date , 'Y/m/d H:i' );
        $data['end_date'] = convertJalaliToDate($request->end_date , 'Y/m/d H:i' );

        $this->commonDiscountRepo->update($discountId, $data);
        newFeedback();
        return to_route('panel.commonDiscounts.index');
    }

    public function destroy($discountId)
    {
        $this->authorize('manage' , Coupon::class);
        $discount = $this->commonDiscountRepo->findById($discountId);
        $this->commonDiscountRepo->destroy($discountId);
        return AjaxResponse::success("تخفیف " . $discount->title . " با موفقیت حذف شد.");
    }
}
