<?php

namespace Modules\User\Http\Requests\Panel;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\User\Models\User;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return[
            'username' => ['required' , 'string' ,Rule::unique('users' , 'username')->ignore( $this->route()->parameter('user')  ) ] ,
            'full_name' => ['required' , 'string' ] ,
            'email' => ['required' , 'email' , Rule::unique('users' , 'email')->ignore( $this->route()->parameter('user')  )] ,
            'password' => ['nullable' , 'password' ] ,
            'profile' => ['nullable' , 'mimes:jpeg,jpg,pin' ] ,
            'status' => ['required' , Rule::in(User::$statuses)] ,
        ];
    }


}
