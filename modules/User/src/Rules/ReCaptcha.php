<?php

namespace Modules\User\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Http;

class ReCaptcha implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
       $response =  Http::get("https://www.google.com/recaptcha/api/siteverify" , [
            'secret' => config('services.google_recaptcha.secret'),
            'response' => $value
        ]);

       return $response->json()['success'];

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'گزینه امنیتی مربوط به شناسایی روبات خاموش می باشد، لطفا از فعال بودن آن اطمینان حاصل نمایید و مجدد امتحان کنید.';
    }
}
