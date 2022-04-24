<?php

namespace Modules\Brand\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required' , 'string' , 'min:2'] ,
            'is_active' => ['required' , 'numeric']
        ];
    }

}
