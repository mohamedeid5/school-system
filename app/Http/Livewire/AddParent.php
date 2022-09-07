<?php

namespace App\Http\Livewire;

use App\Http\Controllers\FileController;
use App\Models\Blood;
use App\Models\Image;
use App\Models\MyParent;
use App\Models\Nationality;
use App\Models\ParentAttachment;
use App\Models\Religion;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddParent extends Component
{

    use WithFileUploads;

    public int $currentStep = 1;

    public $photos = [];

    public $file;

    public bool $showTable = true;

    public $parentId;

    public bool $updateMode = false;

    public $email, $password,
           $father_name_ar, $father_name_en,
           $father_job_ar, $father_job_en,
           $father_national_id, $father_passport_id,
           $father_phone, $father_nationality_id,
           $father_blood_id, $father_religion_id, $father_address,

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
        $parents = MyParent::all();
        $files = Image::where('imageable_id', $this->parentId)->where('imageable_type', 'App\Models\MyParent')->get();


        return view('livewire.add-parent',[
            'nationalities' => $nationalities,
            'bloods' => $bloods,
            'religions' => $religions,
            'parents' => $parents,
            'files' => $files,
        ]);
    }

    public function firstStepSubmit()
    {
        $this->validate([
            'email' => 'required|unique:my_parents,email,'. $this->id,
            'password' => 'required',
            'father_name_ar' => 'required',
            'father_name_en' => 'required',
            'father_job_ar' => 'required',
            'father_job_en' => 'required',
            'father_national_id' => 'required|min:10|max:10|regex:/[0-9]{9}/|unique:my_parents,father_national_id,' . $this->id,
            'father_passport_id' => 'required|min:10|max:10|regex:/[0-9]{9}/|unique:my_parents,father_passport_id,' . $this->id,
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

        $myParent = new MyParent();
        // Father_INPUTS
        $myParent->email = $this->email;
        $myParent->password = Hash::make($this->password);
        $myParent->setTranslations('father_name', $fatherName);
        $myParent->father_national_id = $this->father_national_id;
        $myParent->father_passport_id = $this->father_passport_id;
        $myParent->father_phone = $this->father_phone;
        $myParent->setTranslations('father_job', $fatherJob);
        $myParent->father_nationality_id = $this->father_nationality_id;
        $myParent->father_blood_id = $this->father_blood_id;
        $myParent->father_religion_id = $this->father_religion_id;
        $myParent->father_address = $this->father_address;

        // Mother_INPUTS
        $myParent->setTranslations('mother_name', $motherName);
        $myParent->mother_national_id = $this->mother_national_id;
        $myParent->mother_passport_id = $this->mother_passport_id;
        $myParent->mother_phone = $this->mother_phone;
        $myParent->setTranslations('mother_job', $motherJob);
        $myParent->mother_blood_id = $this->mother_blood_id;
        $myParent->mother_religion_id = $this->mother_religion_id;
        $myParent->mother_nationality_id = $this->mother_nationality_id;
        $myParent->mother_address = $this->mother_address;
        $myParent->save();


        $this->parentAttachments($myParent);

        $this->successMessage = __('messages.success');
        $this->clearForm();
        $this->currentStep = 1;

    }



    /**
     * @param $parent
     * @return void
     */
    protected function parentAttachments($parent)
    {

        if (!empty($this->photos)) {
            foreach ($this->photos as $photo) {

                FileController::upload($photo,  'parent_attachments/' . $parent->id, $photo->getClientOriginalName(), 'public');

                $img = new Image();
                $img->name = $photo->getClientOriginalName();
                $img->imageable_id = $this->parentId;
                $img->imageable_type = 'App\Models\MyParent';
                $img->save();
            }
        }
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

    public function showAddForm()
    {
        $this->showTable = false;
    }

    public function showParentsTable()
    {
        $this->showTable = true;
        $this->clearForm();
    }

    public function edit($parentId)
    {
        $this->showTable = false;
        $this->updateMode = true;

        $parent = MyParent::find($parentId);

        $this->parentId = $parent->id;
        $this->email = $parent->email;
        $this->password = $parent->password;
        $this->father_name_ar = $parent->getTranslation('father_name', 'ar');
        $this->father_name_en = $parent->getTranslation('father_name', 'en');
        $this->father_job_en = $parent->getTranslation('father_job', 'en');
        $this->father_job_ar = $parent->getTranslation('father_job', 'ar');
        $this->father_national_id =$parent->father_national_id;
        $this->father_passport_id = $parent->father_passport_id;
        $this->father_phone = $parent->father_phone;
        $this->father_nationality_id = $parent->father_nationality_id;
        $this->father_blood_id = $parent->father_blood_id;
        $this->father_address = $parent->father_address;
        $this->father_religion_id =$parent->father_religion_id;

        $this->mother_name_ar = $parent->getTranslation('mother_name', 'ar');
        $this->mother_name_en = $parent->getTranslation('mother_name', 'en');
        $this->mother_job_ar = $parent->getTranslation('mother_job', 'ar');
        $this->mother_job_en = $parent->getTranslation('mother_job', 'en');
        $this->mother_national_id = $parent->mother_national_id;
        $this->mother_passport_id = $parent->mother_passport_id;
        $this->mother_phone = $parent->mother_phone;
        $this->mother_blood_id = $parent->mother_blood_id;
        $this->mother_address = $parent->mother_address;
        $this->mother_nationality_id = $parent->mother_nationality_id;
        $this->mother_religion_id =$parent->mother_religion_id;
    }

    public function firstStepEditSubmit()
    {
        $this->validate([
            'email' => 'required|unique:my_parents,email,'.$this->parentId,
            'password' => 'required',
            'mother_name_ar' => 'required',
            'mother_name_en' => 'required',
            'mother_job_ar' => 'required',
            'mother_job_en' => 'required',
            'mother_national_id' => 'required|min:10|max:10|regex:/[0-9]{9}/|unique:my_parents,mother_national_id,' . $this->parentId,
            'mother_passport_id' => 'required|min:10|max:10|regex:/[0-9]{9}/|unique:my_parents,mother_passport_id,' . $this->parentId,
            'mother_phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'mother_nationality_id' => 'required',
            'mother_blood_id' => 'required',
            'mother_religion_id' => 'required',
            'mother_address' => 'required',
        ]);

        $this->updateMode = true;
        $this->currentStep = 2;
    }

    public function secondStepEditSubmit()
    {
        $this->validate([
            'email' => 'required|unique:my_parents,email,'.$this->parentId,
            'password' => 'required',
            'mother_name_ar' => 'required',
            'mother_name_en' => 'required',
            'mother_job_ar' => 'required',
            'mother_job_en' => 'required',
            'mother_national_id' => 'required|min:10|max:10|regex:/[0-9]{9}/|unique:my_parents,mother_national_id,' . $this->parentId,
            'mother_passport_id' => 'required|min:10|max:10|regex:/[0-9]{9}/|unique:my_parents,mother_passport_id,' . $this->parentId,
            'mother_phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'mother_nationality_id' => 'required',
            'mother_blood_id' => 'required',
            'mother_religion_id' => 'required',
            'mother_address' => 'required',
        ]);

        $this->updateMode = true;
        $this->currentStep = 3;
    }

    public function submitEditForm()
    {

        $fatherName = ['en' => $this->father_name_en, 'ar' => $this->father_name_ar];
        $fatherJob = ['en' => $this->father_job_en, 'ar' => $this->father_job_ar];
        $motherJob = ['en' => $this->mother_job_en, 'ar' => $this->mother_job_ar];
        $motherName = ['en' => $this->mother_name_en, 'ar' => $this->mother_name_ar];

        if ($this->parentId) {


            $myParent = MyParent::find($this->parentId);
            // Father_INPUTS
            $myParent->email = $this->email;
            $myParent->password = Hash::make($this->password);
            $myParent->setTranslations('father_name', $fatherName);
            $myParent->father_national_id = $this->father_national_id;
            $myParent->father_passport_id = $this->father_passport_id;
            $myParent->father_phone = $this->father_phone;
            $myParent->setTranslations('father_job', $fatherJob);
            $myParent->father_nationality_id = $this->father_nationality_id;
            $myParent->father_blood_id = $this->father_blood_id;
            $myParent->father_religion_id = $this->father_religion_id;
            $myParent->father_address = $this->father_address;

            // Mother_INPUTS
            $myParent->setTranslations('mother_name', $motherName);
            $myParent->mother_national_id = $this->mother_national_id;
            $myParent->mother_passport_id = $this->mother_passport_id;
            $myParent->mother_phone = $this->mother_phone;
            $myParent->setTranslations('mother_job', $motherJob);
            $myParent->mother_blood_id = $this->mother_blood_id;
            $myParent->mother_religion_id = $this->mother_religion_id;
            $myParent->mother_nationality_id = $this->mother_nationality_id;
            $myParent->mother_address = $this->mother_address;
            $myParent->save();


            $this->parentAttachments($myParent);

            $this->successMessage = __('messages.update');
            $this->clearForm();
            $this->currentStep = 1;
            $this->updateMode = false;
        }

    }


    public function delete($parentId)
    {

        if ($parentId) {

            MyParent::find($parentId)->delete();

            //Storage::disk('public')->deleteDirectory('parent_attachments/' . $parentId);
            //File::deleteDirectory(public_path('storage/parent_attachments/' . $parentId));

            FileController::deleteDirectory('parent_attachments/' . $parentId);

            $this->successMessage = __('messages.deleted');
        }
    }

    public function deleteFile($file, $parentId)
    {

        ParentAttachment::where('parent_id', $parentId)->where('file_name', $file)->delete();

        FileController::deleteFile('parent_attachments/'  . $parentId . '/' . $file);

        $this->successMessage = __('messages.deleted');
    }


}
