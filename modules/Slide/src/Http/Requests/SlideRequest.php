<?php

namespace Modules\Slide\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Modules\Slide\Enums\SlideStatus;
use Modules\Slide\Enums\SlideType;
use Modules\Slide\Models\Slide;

class SlideRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        $slide = $this->route()->parameter('side');
        $rules =  [
            'title' => ['nullable', 'string'],
            'priority' => ['nullable' , Rule::unique('sliders' , 'priority')],
            'status' => ['required', new Enum(SlideStatus::class)],
            'type' => ['required', new Enum(SlideType::class)],
            'link' => ['required', 'url'],
            'btn_text' => ['nullable', 'string'],
            'photo' => ['required', 'image', 'mimes:png,jpeg,jpg'],
        ];

        if ($this->getMethod() == 'PATCH'){
            $rules['photo'] = ['nullable', 'image', 'mimes:png,jpeg,jpg'];
            $rules['priority'] = ['nullable' ];
        }


        return $rules;
    }

    public function attributes()
    {
        return [
            'status' => 'وضعیت',
            'type' => 'نوع',
            'link' => 'لینک',
            'btn_text' => 'متن دکمه',
            'photo' => 'عکس',
        ];
    }

}
