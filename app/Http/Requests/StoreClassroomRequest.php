<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClassroomRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'list_classes.*.name' => 'required',
            'list_classes.*.name_en' => 'required',
            'list_classes.*.grade_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'list_classes.*.name.required' =>  __('validation.required'),
            'name_en.required' =>  __('validation.required'),
        ];
    }
}
