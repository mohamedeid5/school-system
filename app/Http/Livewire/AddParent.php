<?php

namespace App\Http\Livewire;

use App\Models\Blood;
use App\Models\MyParent;
use App\Models\Nationality;
use App\Models\Religion;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class AddParent extends Component
{

    public int $currentStep = 1;

    public $email, $password,
        $father_name_ar, $father_name_en,
        $father_job_ar, $father_job_en,
        $father_national_id, $father_passport_id, $father_phone,
        $father_nationality_id, $father_blood_id,
        $father_religion_id, $father_address,

    // mother vars
        $mother_name_ar, $mother_name_en,
        $mother_job_ar, $mother_job_en,
        $mother_national_id, $mother_passport_id, $mother_phone,
        $mother_nationality_id, $mother_blood_id,
        $mother_religion_id, $mother_address;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:6',
        'father_name_ar' => 'required',
        'father_name_en' => 'required',
        'father_national_id' => 'required|string|min:10|max:10|regex:/[0-9]{9}/',
        'father_passport_id' => 'required|string|min:10|max:10',
        'father_phone' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        'mother_national_id' => 'required|string|min:10|max:10|regex:/[0-9]{9}/',
        'mother_passport_id' => 'min:10|max:10',
        'mother_phone' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {

        $nationalities = Nationality::all();
        $bloods = Blood::all();
        $religions = Religion::all();

        return view('livewire.add-parent',[
            'nationalities' => $nationalities,
            'bloods' => $bloods,
            'religions' => $religions,
        ]);
    }

    public function firstStepSubmit()
    {
        $this->validate([
            'email' => 'required|unique:my_parents,email,'.$this->id,
            'password' => 'required',
            'father_name_ar' => 'required',
            'father_name_en' => 'required',
            'father_job_ar' => 'required',
            'father_job_en' => 'required',
            'father_national_id' => 'required|min:10|max:10|regex:/[0-9]{9}/|unique:my_parents,father_national_id',
            'father_passport_id' => 'required|min:10|max:10|regex:/[0-9]{9}/|unique:my_parents,father_passport_id',
            'father_phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'father_nationality_id' => 'required',
            'father_blood_id' => 'required',
            'father_religion_id' => 'required',
            'father_address' => 'required',
        ]);

        $this->currentStep = 2;
    }

    public function secondStepSubmit()
    {
        $this->validate([
            'email' => 'required|unique:my_parents,email,'.$this->id,
            'password' => 'required',
            'mother_name_ar' => 'required',
            'mother_name_en' => 'required',
            'mother_job_ar' => 'required',
            'mother_job_en' => 'required',
            'mother_national_id' => 'required|min:10|max:10|regex:/[0-9]{9}/|unique:my_parents,mother_national_id,' . $this->id,
            'mother_passport_id' => 'required|min:10|max:10|regex:/[0-9]{9}/|unique:my_parents,mother_passport_id,' . $this->id,
            'mother_phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'mother_nationality_id' => 'required',
            'mother_blood_id' => 'required',
            'mother_religion_id' => 'required',
            'mother_address' => 'required',
        ]);

        $this->currentStep = 3;
    }

    public function back($step)
    {
        $this->currentStep = $step;
    }

    public function submitForm()
    {

        $fatherName = ['en' => $this->father_name_en, 'ar' => $this->father_name_ar];
        $fatherJob = ['en' => $this->father_job_en, 'ar' => $this->father_job_ar];
        $motherJob = ['en' => $this->mother_job_en, 'ar' => $this->mother_job_ar];
        $motherName = ['en' => $this->mother_name_en, 'ar' => $this->mother_name_ar];

        $MyParent = new MyParent();
        // Father_INPUTS
        $MyParent->email = $this->email;
        $MyParent->password = Hash::make($this->password);
        $MyParent->setTranslations('father_name', $fatherName);
        $MyParent->father_national_id = $this->father_national_id;
        $MyParent->father_passport_id = $this->father_passport_id;
        $MyParent->father_phone = $this->father_phone;
        $MyParent->setTranslations('father_job', $fatherJob);
        $MyParent->father_nationality_id = $this->father_nationality_id;
        $MyParent->father_blood_id = $this->father_blood_id;
        $MyParent->father_religion_id = $this->father_religion_id;
        $MyParent->father_address = $this->father_address;

        // Mother_INPUTS
        $MyParent->setTranslations('mother_name', $motherName);
        $MyParent->mother_national_id = $this->mother_national_id;
        $MyParent->mother_passport_id = $this->mother_passport_id;
        $MyParent->mother_phone = $this->mother_phone;
        $MyParent->setTranslations('mother_job', $motherJob);
        $MyParent->mother_blood_id = $this->mother_blood_id;
        $MyParent->mother_religion_id = $this->mother_religion_id;
        $MyParent->mother_nationality_id = $this->mother_nationality_id;
        $MyParent->mother_address = $this->mother_address;

        $MyParent->save();
        $this->successMessage = __('messages.success');
        $this->clearForm();
        $this->currentStep = 1;


    }

    public function clearForm()
    {
        $this->email = '';
        $this->password = '';
        $this->father_name_ar = '';
        $this->father_name_en = '';
        $this->father_job_en = '';
        $this->father_job_ar = '';
        $this->father_national_id ='';
        $this->father_passport_id = '';
        $this->father_phone = '';
        $this->father_nationality_id = '';
        $this->father_blood_id = '';
        $this->father_address ='';
        $this->father_religion_id ='';

        $this->mother_name_ar = '';
        $this->mother_name_en = '';
        $this->mother_job_ar = '';
        $this->mother_job_en = '';
        $this->mother_national_id ='';
        $this->mother_passport_id = '';
        $this->mother_phone = '';
        $this->mother_blood_id = '';
        $this->mother_address ='';
        $this->mother_religion_id ='';

    }


}
