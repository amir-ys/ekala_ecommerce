<?php

namespace Modules\Attribute\Http\Requests\AttributeValue;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SaveAttributeValueRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'attributeValue' => ['required' , 'array'] ,
            'attributeValue.*' => ['required' , 'string' , Rule::unique('attribute_values' , 'value')] ,
        ];
    }

    public function attributes()
    {
        return [
            'attributeValue' => 'مقدار ویژگی' ,
            'attributeValue.*' => 'مقدار ویژگی'
        ];
    }

}
