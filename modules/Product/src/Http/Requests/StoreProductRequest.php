<?php

namespace Modules\Product\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Modules\Product\Enums\ProductStatus;

class StoreProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:1000'],
            'quantity' => ['required', 'numeric', 'min:0'],
            'brand_id' => ['required', Rule::exists('brands', 'id')],
            'category_id' => ['required', Rule::exists('categories', 'id')],
            'is_active' => ['required', new Enum(ProductStatus::class)],
            'description' => ['required'],
            'primary_image' => ['required', 'image', 'mimes:jpeg,jpg,png'],
            'images' => ['nullable', 'array'],
            'images.*' => ['nullable', 'image', 'mimes:jpeg,jpg,png'],
            'special_price' => ['nullable', 'numeric'],
            'special_price_start' => ['nullable', Rule::requiredIf(function () {
                return request()->special_price != null;
            })],
            'special_price_end' => ['nullable', 'date', Rule::requiredIf(function () {
                return request()->special_price != null;
            })]
        ];
    }

    public function attributes()
    {
        return [
            'price' => 'قیمت',
            'primary_image' => 'تصویر اصلی',
            'quantity' => 'موجودی',
            'brand_id' => 'دیته بندی',
            'category_id' => 'برند',
            'special_price' => 'قیمت تخفیف',
            'special_price_start' => 'تاریخ شروع',
            'special_price_end' => 'تاریخ پابان',
        ];
    }

}
