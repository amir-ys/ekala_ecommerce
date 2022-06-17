<?php

namespace Modules\Comment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCommentRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $this->redirect = url()->previous() . '#comments-tab';
        return [
            'product_id' => ['required' , Rule::exists('products' , 'id')] ,
            'parent_id' => ['nullable' , 'numeric'] ,
            'body' => ['required' , 'string'] ,
        ];
    }


    public function attributes()
    {
        return [
            'body' => 'متن دیدگاه'
        ];
    }

}
