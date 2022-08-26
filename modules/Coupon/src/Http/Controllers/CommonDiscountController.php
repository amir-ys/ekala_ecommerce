<?php

namespace Modules\Coupon\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Core\Responses\AjaxResponse;
use Modules\Coupon\Contracts\CommonDiscountRepositoryInterface;
use Modules\Coupon\Http\Requests\CommonDiscountRequest;


class CommonDiscountController extends Controller
{
    private CommonDiscountRepositoryInterface $commonDiscountRepo;

    public function __construct(CommonDiscountRepositoryInterface $commonDiscountRepo)
    {
        $this->commonDiscountRepo = $commonDiscountRepo;
    }

    public function index()
    {
        $discounts = $this->commonDiscountRepo->getAll();
        return view('Discount::common-discounts.index', compact('discounts'));
    }

    public function create()
    {
        return view('Discount::common-discounts.create');
    }

    public function store(CommonDiscountRequest $request)
    {
        $this->commonDiscountRepo->store($request->all());
        newFeedback();
        return to_route('panel.commonDiscounts.index');
    }

    public function edit($discountId)
    {
        $discount = $this->commonDiscountRepo->findById($discountId);
        return view('Discount::common-discounts.edit', compact('discount'));
    }

    public function update(CommonDiscountRequest $request, $discountId)
    {
        $this->commonDiscountRepo->update($discountId, $request->all());
        newFeedback();
        return to_route('panel.commonDiscounts.index');
    }

    public function destroy($discountId)
    {
        $discount = $this->commonDiscountRepo->findById($discountId);
        $this->commonDiscountRepo->destroy($discountId);
        return AjaxResponse::success("تخفیف " . $discount->title . " با موفقیت حذف شد.");
    }
}
