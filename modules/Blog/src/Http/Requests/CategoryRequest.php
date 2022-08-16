<?php

namespace Modules\Blog\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'name' => ['required', 'string', 'min:2'],
            'description' => ['nullable', 'string'],
            'status' => ['required'],
            'image' => ['required', 'image', 'mimes:jpeg,jpg,png'],
        ];

        if ($this->method() == 'PATCH') {
            $rules['image'] = ['nullable', 'image', 'mimes:jpeg,jpg,png'];
        }

        return $rules;

    }

    public function attributes()
    {
        return [
            'image' => 'تصویر',
            'status' => 'وضعیت',
            'tags' => 'تگ'
        ];
    }
}
