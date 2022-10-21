<?php
namespace Modules\RolePermissions\Http\Requests;



use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|min:2' ,
            'permissions' => 'required|array' ,
            'permissions.*' => ['required' , Rule::exists('permissions','id')] ,
        ];
    }

    public function messages()
    {
        return [
            'permissions.required' => 'حداقل باید یک مجوز انتخاب کنید.'
        ];
    }

}
