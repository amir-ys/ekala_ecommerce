<?php

namespace Modules\AttributeGroup\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttributeGroupRequest extends FormRequest
{
    public function authorize()
    {
       return true;
    }

    public function rules()
    {
       return [
           'name' => ['required' , 'string' , 'min:2']
       ];
    }

}
