<?php

namespace Modules\Setting\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AboutRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => [ 'nullable' , 'string'],
            'photo' => [ 'image' , 'mimes:jpeg,jpg,png'],
            'description' => [ 'nullable' , 'string'],
        ];
    }

}
