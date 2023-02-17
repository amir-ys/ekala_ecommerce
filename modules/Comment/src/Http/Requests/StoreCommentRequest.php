<?php

namespace Modules\Comment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\User\Models\User;

class StoreCommentRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $this->redirect = url()->previous() . '#comments-tab';
        return [
            'commentable_id' => ['required' ] ,
            'commentable_type' => ['required' ] ,
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
