<?php

namespace Modules\Product\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductColorRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'color_name' => ['required', 'string'],
            'color_value' => ['required', 'string'],
            'price_increase' => ['required', 'numeric'],
            'quantity' => ['required', 'numeric'],
        ];
    }

    public function attributes()
    {
        return [
            'color_name' => 'نام',
            'color_value' => 'کد رنگ ',
            'price_increase' => 'افزایش قیمت',
            'quantity' => 'موجودی',
        ];
    }

}
