<?php

namespace Modules\Setting\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FaqRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'question' => ['required', 'string'],
            'answer' => ['required', 'string']
        ];
    }

    public function attributes()
    {
        return [
            'question' => 'سوال',
            'answer' => 'جواب',
        ];
    }

}
