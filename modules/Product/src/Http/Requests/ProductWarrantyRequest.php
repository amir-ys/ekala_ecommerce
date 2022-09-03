<?php

namespace Modules\Product\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductWarrantyRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'price_increase' => ['required', 'numeric'],
        ];
    }

    public function attributes()
    {
        return [
            'price_increase' => 'افزایش قیمت',
        ];
    }

}
