<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
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
            'name_ar' => 'required',
            'name_en' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'gender_id' => 'required',
            'nationality_id' => 'required',
            'blood_id' => 'required',
            'grade_id' => 'required',
            'classroom_id' => 'required',
            'section_id' => 'required',
            'parent_id' => 'required',
            'date_of_birth' => 'required|date',
            'academic_year' => 'required',
        ];
    }
}
