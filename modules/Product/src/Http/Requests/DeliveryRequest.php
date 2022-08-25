<?php

namespace Modules\Product\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeliveryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'amount' => ['required', 'numeric'],
            'delivery_time' => ['required', 'numeric'],
            'delivery_unit' => ['required', 'string'],
        ];
    }

    public function attributes()
    {
        return [
            'amount' => 'قیمت',
            'delivery_time' => 'زمان ارسال',
            'delivery_unit' => ' واحد زمان ارسال',
        ];
    }

}
