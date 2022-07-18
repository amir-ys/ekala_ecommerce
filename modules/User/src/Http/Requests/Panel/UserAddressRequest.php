<?php

namespace Modules\User\Http\Requests\Panel;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserAddressRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return  [
            'province_id' => ['required', Rule::exists('provinces', 'id')],
            'city_id' => ['required', Rule::exists('cities', 'id')],
            'address' => ['required', 'string'],
            'receiver' => ['required', 'string'],
            'postal_code' => ['required'],
            'phone_number' => ['required'],
        ];
    }

    public function attributes()
    {
        return [
            'province_id' => 'استان',
            'city_id' => 'شهر',
            'address' => 'ادرس',
            'receiver' => 'گیرنده',
            'postal_code' => 'کد پستی',
            'phone_number' =>  'شماره تماس گیرنده',
        ];
    }


}
