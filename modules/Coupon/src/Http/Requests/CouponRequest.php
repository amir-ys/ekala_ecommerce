<?php

namespace Modules\Coupon\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Coupon\Models\Coupon;

class CouponRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'code' => ['required', Rule::unique('coupons', 'code')],
            'type' => ['required', Rule::in(Coupon::$types)],
            'use_type' => ['required', Rule::in(Coupon::$useTypes)],
            'status' => ['required', Rule::in(Coupon::$statuses)],
            'amount' => [Rule::requiredIf(function () {
                return $this->type == Coupon::TYPE_AMOUNT;
            })],
            'percent' => [Rule::requiredIf(function () {
                return $this->type == Coupon::TYPE_PERCENT;
            })],
            'user_id' => [Rule::requiredIf(function () {
                return $this->use_type == Coupon::USE_TYPE_PRIVATE;
            })],
            'discount_ceiling' => ['required', 'numeric'],
            'start_date' => ['required'],
            'end_date' => ['required'],
        ];

        if ($this->getMethod() == 'PATCH') {
            $rules['code'] = ['required', Rule::unique('coupons', 'code')->ignore($this->route()->parameter('coupon'))];
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'code' => 'کد',
            'amount' => 'مقدار',
            'percent' => 'درصد',
            'type' => 'نوع',
            'user_id' => 'کاربر',
        ];
    }
}
