<?php

namespace Modules\Blog\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Blog\Models\Post;

class PostRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'title' => ['required', 'string', 'min:2'],
            'summery' => ['required', 'string', 'min:2'],
            'body' => ['nullable', 'string'],
            'status' => ['required' , Rule::in(Post::$statuses)],
            'is_commentable' => ['required' , Rule::in(Post::$commentable)],
            'published_at' => ['required' , 'date'  ],
            'category_id' => ['required' ,  Rule::exists('blog_categories' , 'id') ],
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
