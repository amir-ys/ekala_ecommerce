<?php

namespace Modules\Category\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'name' => ['required' , 'string' , 'min:2'] ,
            'parent_id' => ['nullable' , Rule::exists('categories' , 'id') ] ,
            'is_active' => ['required' ] ,
            'is_searchable' => ['nullable'] ,
        ];

    }
}
