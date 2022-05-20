<?php

namespace Modules\Attribute\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AttributeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required' , 'string'] ,
            'attribute_group_id' => ['required' , Rule::exists('attribute_groups' , 'id')] ,
            'is_filterable' => [ 'nullable' , 'numeric' ]
        ];
    }

    public function attributes()
    {
        return [
            'attribute_group_id' => 'گروه ویژگی'
        ];
    }

}
