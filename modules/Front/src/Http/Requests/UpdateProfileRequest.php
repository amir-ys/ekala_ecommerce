<?php

namespace Modules\Front\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => ['required', 'string', 'min:2'],
            'last_name' => ['required', 'string'],
            'national_code' => ['nullable', 'string', 'digits:10'],
            'mobile' => ['required', 'string', 'min:11'],
            'email' => ['required', 'email'],
            'cart_number' => ['nullable', 'digits:16'],
        ];
    }

    public function prepareForValidation()
    {
        $this->offsetUnset('_token');
        $this->offsetUnset('_method');
        if ($this->filled('password')) {
            $this->merge([
                'password' => bcrypt($this->password)
            ]);
        } else {
            $this->offsetUnset('password');
        }
    }

    public function attributes()
    {
        return [
            'cart_number' => 'شماره کارت'
        ];
    }
}
