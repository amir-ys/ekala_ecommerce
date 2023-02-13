<?php

namespace Modules\Otp\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterCompletionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => ['required',  'string' , 'min:2' , 'max:255'] ,
            'last_name' => ['required',  'string' , 'min:2' , 'max:255'] ,
            'email' => ['nullable',  'email' , Rule::unique('users' , 'email') ]
        ];
    }

}
