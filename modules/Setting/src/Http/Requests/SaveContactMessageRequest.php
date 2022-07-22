<?php

namespace Modules\Setting\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveContactMessageRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['nullable' ,'string'],
            'email' => ['required' , 'email'],
            'phone_number' => ['nullable' , 'numeric'],
            'subject' => ['required' , 'string'],
            'message' => ['required' , 'string'],
        ];
    }

    public function attributes()
    {
        return [
            'subject' => 'موضوع' ,
            'message' => 'پیام'
        ];
    }

}
