<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SectionsRequest extends FormRequest
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
            'name' => 'required|unique:grades,name->ar,'.$this->id,
            'name_en' => 'required|unique:grades,name->en,'.$this->id,
            'grade_id' => 'required',
            'classroom_id' => 'required'
        ];
    }
}
