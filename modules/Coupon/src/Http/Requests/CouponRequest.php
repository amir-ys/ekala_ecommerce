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
            'amount' => [Rule::requiredIf(function () {
                return $this->type == Coupon::TYPE_AMOUNT;
            })],
            'percent' => [Rule::requiredIf(function () {
                return $this->type == Coupon::TYPE_PERCENT;
            })],
            'expired_at' => ['required'],
            'description' => ['nullable', 'nullable'],
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
            'expired_at' => 'تاریخ اعتبار',
        ];
    }
}
