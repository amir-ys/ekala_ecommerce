<?php

namespace Modules\Coupon\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Coupon\Models\CommonDiscount;

class CommonDiscountRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'title' => ['required', 'string'],
            'percent' => ['required', 'min:1', 'max:100'],
            'discount_ceiling' => ['required', 'numeric'],
            'minimal_order_amount' => ['nullable', 'numeric'],
            'start_date' => ['required'],
            'end_date' => ['required'],
            'status' => ['required', Rule::in(CommonDiscount::$statuses)],
        ];
        return $rules;
    }

    public function attributes()
    {
        return [
            'discount_ceiling' => 'حداکثر تخفیف مبلفی',
            'minimal_order_amount' => 'کمتربن مقدار سفارش',
            'start_date' => 'تاریخ شروع',
            'end_date' => 'تاریخ پایان',];
    }
}
