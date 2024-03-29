<?php

namespace Modules\Product\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Modules\Product\Enums\ProductStatus;
use Modules\Product\Models\Product;

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
            'is_marketable' => ['required', Rule::in(Product::$morketableStatuses)],
            'description' => ['required'],
            'primary_image' => ['required', 'image', 'mimes:jpeg,jpg,png'],
            'images' => ['nullable', 'array'],
            'images.*' => ['nullable', 'image', 'mimes:jpeg,jpg,png'],
            'special_price' => ['nullable', 'numeric'],
            'special_price_start' => ['nullable', Rule::requiredIf(function () {
                return request()->special_price != null;
            })],
            'special_price_end' => ['nullable', Rule::requiredIf(function () {
                return request()->special_price != null;
            }),],
            'color_name' => ['required'],
            'color_value' => ['required'],
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
            'color_name' => 'رنگ',
            'color_value' => 'کد رنگ',
        ];
    }


    protected function prepareForValidation()
    {
        if ($this->filled(['special_price' ,'special_price_start' , 'special_price_end' ])) {
            $this->merge([
                'special_price_start' => convertJalaliToDate($this->special_price_start, 'Y/m/d H:i'),
                'special_price_end' => convertJalaliToDate($this->special_price_end, 'Y/m/d H:i'),
            ]);
        }else{
            $this->merge([
                'special_price' => null,
                'special_price_start' => null,
                'special_price_end' => null,
            ]);
        }

        $this->mergeIfMissing([
            'user_id' => auth()->id(),
        ]);
    }

}
