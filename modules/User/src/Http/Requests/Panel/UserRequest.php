<?php

namespace Modules\User\Http\Requests\Panel;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Modules\User\Models\User;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'first_name' => ['nullable', 'string', 'min:2'],
            'last_name' => ['nullable', 'string', 'min:2'],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($this->route()->parameter('user'))],
            'password' => ['required', Password::min(8)],
            'profile' => ['nullable', 'mimes:jpeg,jpg,png'],
            'status' => ['required', Rule::in(User::$statuses)],
        ];

        if ($this->getMethod() == 'PATCH') {
            $rules['password'] = ['nullable', Password::min(8)];
        }


        return $rules;

    }

    public function prepareForValidation()
    {
        $this->merge([
            'username' => null ,
            'is_admin' => User::ROLE_USER
        ]);
    }


}
