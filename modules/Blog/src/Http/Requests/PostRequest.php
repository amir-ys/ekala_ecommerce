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
            'summary' => ['required', 'string'],
            'body' => ['required', 'string'],
            'status' => ['required', Rule::in(Post::$statuses)],
            'is_commentable' => ['required', Rule::in(Post::$commentable)],
            'published_at' =>  ['nullable'],
            'category_id' => ['required', Rule::exists('blog_categories', 'id')],
            'image' => ['required', 'image', 'mimes:jpeg,jpg,png'],
            'tags' => ['required', 'array'],
        ];

        if ($this->method() == 'PATCH') {
            $rules['image'] = ['nullable', 'image', 'mimes:jpeg,jpg,png'];
        }

        return $rules;

    }
    protected function prepareForValidation()
    {
        if ($this->filled(['published_at'])) {
            $this->merge([
                'published_at' => convertJalaliToDate($this->published_at, 'Y/m/d H:i'),
            ]);
        }else{
            $this->merge([
                'published_at' => null,
            ]);
        }

        $this->merge([
            'author_id' => auth()->id()
        ]);
    }

    public function attributes()
    {
        return [
            'image' => 'تصویر',
            'status' => 'وضعیت',
            'summery' => 'متن خلاصه',
            'body' => 'متن اصلی',
            'category_id' => 'دسته بندی',
            'published_at' => ' قابلیت درج کامنت',
        ];
    }
}
