<?php

namespace Modules\User\Http\Requests\Panel;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Modules\User\Models\User;

class AdminRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'first_name' => ['required', 'string', 'min:2'],
            'last_name' => ['required', 'string', 'min:2'],
            'national_code' => ['required', 'numeric', 'digits:10'],
            'mobile' => ['required', 'numeric'],
            'username' => ['required', 'string', Rule::unique('users', 'username')->ignore($this->route()->parameter('admin'))],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($this->route()->parameter('admin'))],
            'password' => ['required', Password::min(8)],
            'profile' => ['required', 'mimes:jpeg,jpg,png'],
            'status' => ['required', Rule::in(User::$statuses)],
        ];

        if ($this->getMethod() == 'PATCH') {
            $rules['password'] = ['nullable', Password::min(8)] ;
            $rules['profile'] = ['nullable', 'mimes:jpeg,jpg,png'];
        }


        return $rules;

    }

    public function prepareForValidation()
    {
        $this->merge([
           'is_admin' => User::ROLE_ADMIN ,
//           'password' =>
        ]);
    }

    public function attributes()
    {
        return [
            'national_code' => 'کد ملی'
        ];
    }

}
