<?php

namespace Modules\Otp\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConfirmOtpRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'code' => ['required', 'numeric'] ,
            'phone_number' => ['required', 'numeric', 'digits:11']
        ];
    }

}
