<?php

namespace Modules\AttributeGroup\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AttributeGroupRequest extends FormRequest
{
    public function authorize()
    {
       return true;
    }

    public function rules()
    {
       return [
           'name' => ['required' , 'string' , 'min:2'] ,
           'category_id' => ['required' , Rule::exists('categories' , 'id')]
       ];
    }

    public function attributes()
    {
        return [
            'category_id' => 'دسته بندی'
        ];
    }

}
