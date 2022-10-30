<?php

namespace Modules\Comment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\User\Models\User;

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
            'model_id' => ['required' ] ,
            'model_type' => ['required' ] ,
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
    protected function prepareForValidation()
    {
        $this->merge([
            'user_id' => auth()->id(),
            'is_admin' => auth()->user()->isAdmin() ? User::ROLE_ADMIN : User::ROLE_USER ,
        ]);
    }

}
