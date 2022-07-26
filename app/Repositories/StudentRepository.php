<?php

namespace App\Repositories;

use App\Interfaces\StudentRepositoryInterface;
use App\Models\Blood;
use App\Models\Classroom;
use App\Models\Gender;
use App\Models\Grade;
use App\Models\Image;
use App\Models\MyParent;
use App\Models\Nationality;
use App\Models\Section;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StudentRepository implements StudentRepositoryInterface
{

    public function getAllStudents()
    {
        return Student::all();
    }

    public function createStudent($studentDetails)
    {

        DB::beginTransaction();

        $translations = [
            'en' => $studentDetails->name_en,
            'ar' => $studentDetails->name_ar
        ];

        $student = new Student;

        $student->name = $translations;
        $student->email = $studentDetails->email;
        $student->password = Hash::make($studentDetails->password);
        $student->gender_id = $studentDetails->gender_id;
        $student->nationality_id = $studentDetails->nationality_id;
        $student->blood_id = $studentDetails->blood_id;
        $student->date_birth = $studentDetails->date_of_birth;
        $student->classroom_id = $studentDetails->classroom_id;
        $student->section_id = $studentDetails->section_id;
        $student->parent_id = $studentDetails->parent_id;
        $student->grade_id = $studentDetails->grade_id;
        $student->academic_year = $studentDetails->academic_year;
        $student->save();

        // add student images

        if ($studentDetails->hasFile('images')) {

            foreach ($studentDetails->images as $image) {

                $file = $image->storeAs('students/' . $student->id, $image->getClientOriginalName(), 'public');

                $img = new Image();
                $img->name = $image->getClientOriginalName();
                $img->imageable_id = $student->id;
                $img->imageable_type = 'App\Models\Student';
                $img->save();
            }

        }

        DB::commit();

        return redirect()->route('students.index');
    }

    public function editStudent($studentId)
    {
        return Student::findOrFail($studentId);
    }

    public function updateStudent($studentDetails, $studentId)
    {
        $translations = [
            'en' => $studentDetails->name_en,
            'ar' => $studentDetails->name_ar
        ];

        $student = Student::findOrFail($studentId);

        $student->name = $translations;
        $student->email = $studentDetails->email;
        if(empty($studentDetails->password)) {
            $student->password = $studentDetails->old_password;
        } else {
            $student->password = Hash::make($studentDetails->password);
        }
        $student->gender_id = $studentDetails->gender_id;
        $student->nationality_id = $studentDetails->nationality_id;
        $student->blood_id = $studentDetails->blood_id;
        $student->date_birth = $studentDetails->date_birth;
        $student->classroom_id = $studentDetails->classroom_id;
        $student->section_id = $studentDetails->section_id;
        $student->parent_id = $studentDetails->parent_id;
        $student->grade_id = $studentDetails->grade_id;
        $student->academic_year = $studentDetails->academic_year;
        $student->save();

        if ($studentDetails->hasFile('images')) {

            foreach ($studentDetails->images as $image) {

                $file = $image->storeAs('students/' . $student->id, $image->getClientOriginalName(), 'public');

                $img = new Image();
                $img->name = $image->getClientOriginalName();
                $img->imageable_id = $student->id;
                $img->imageable_type = 'App\Models\Student';
                $img->save();
            }

        }

        return redirect()->back();
    }

    public function getStudentById($studentId)
    {
        return Student::find($studentId);
    }

    public function deleteStudent($studentId)
    {
        Student::find($studentId)->delete();

        return redirect()->route('students.index');
    }

    public function getGenders()
    {
        return Gender::all();
    }

    public function getNationalities()
    {
        return Nationality::all();
    }

    public function getBloods()
    {
        return Blood::all();
    }

    public function getClassrooms()
    {
        return Classroom::all();
    }

    public function getParents()
    {
        return MyParent::all();
    }

    public function getGrades()
    {
        return Grade::all();
    }

    public function getAllSections()
    {
        return Section::all();
    }

    public function getSections($id)
    {
        return Section::where('classroom_id', $id)->pluck('name', 'id');
    }

    public function uploadAttachments($request)
    {

        foreach ($request->images as $image) {

            $file = $image->storeAs('students/' . $request->student_id, $image->getClientOriginalName(), 'public');

            $img = new Image();
            $img->name = $image->getClientOriginalName();
            $img->imageable_id = $request->student_id;
            $img->imageable_type = 'App\Models\Student';
            $img->save();
        }

        return redirect()->back();

    }

    public function deleteAttachment($request)
    {
        Storage::disk('public')->delete('students/' . $request->student_id . '/' . $request->name);

        Image::where('id', $request->id)->delete();

        return redirect()->back();
    }

    public function downloadAttachment($id, $name)
    {
        return response()->download(public_path('storage/students/'. $id . '/' .$name));
    }
}
