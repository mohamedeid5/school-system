<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeacherRequest extends FormRequest
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
            'email' => 'required|unique:teachers,email',
            'password' => 'required|min:8',
            'name_en' => 'required|min:3',
            'name_ar' => 'required|min:3',
            'gender_id' => 'required',
            'specialization_id' => 'required',
            'joining_date' => 'required',
            'address' => 'required',
        ];
    }
}
