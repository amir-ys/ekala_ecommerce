<?php

namespace Modules\Otp\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\User\Rules\ReCaptcha;

class OtpRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'phone_number' => ['required', 'numeric', 'digits:11'],
            'g-recaptcha-response' => [new ReCaptcha]
        ];
    }

}
