<?php

namespace App\Repositories;

use App\Interfaces\TeacherRepositoryInterface;
use App\Models\Gender;
use App\Models\Specialization;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class TeacherRepository implements TeacherRepositoryInterface
{

    public function getAllTeachers(): \Illuminate\Database\Eloquent\Collection|array
    {
        return Teacher::all();
    }

    public function createTeacher($teacherDetails): \Illuminate\Http\RedirectResponse
    {
        $translations = [
            'en' => $teacherDetails->name_en,
            'ar' => $teacherDetails->name_ar
        ];

        $teacher = new Teacher();
        $teacher->name = $translations;
        $teacher->email = $teacherDetails->email;
        $teacher->password = Hash::make($teacherDetails->password);
        $teacher->address = $teacherDetails->address;
        $teacher->joining_date = $teacherDetails->joining_date;
        $teacher->specialization_id = $teacherDetails->specialization_id;
        $teacher->gender_id = $teacherDetails->gender_id;
        $teacher->save();

        return redirect()->route('teachers.index');
    }

    public function editTeacher($teacherId)
    {
        return Teacher::findOrFail($teacherId);
    }

    public function updateTeacher($teacherDetails, $teacherId)
    {
        $translations = [
            'en' => $teacherDetails->name_en,
            'ar' => $teacherDetails->name_ar
        ];

        $teacher = Teacher::find($teacherId);
        $teacher->name = $translations;
        $teacher->email = $teacherDetails->email;
        if (empty($teacherDetails->password)){

            $teacher->password = $teacherDetails->old_password;
        } else {
            $teacher->password = Hash::make($teacherDetails->password);
        }

        $teacher->address = $teacherDetails->address;
        $teacher->joining_date = $teacherDetails->joining_date;
        $teacher->specialization_id = $teacherDetails->specialization_id;
        $teacher->gender_id = $teacherDetails->gender_id;
        $teacher->save();

        return redirect()->back();
    }

    public function getTeacherById($teacherId)
    {
        // TODO: Implement getTeacherById() method.
    }

    public function deleteTeacher($teacherId)
    {
        $teacher = Teacher::find($teacherId);
        $teacher->delete();

        return redirect()->route('teachers.index');
    }

    public function getSpecializations(): \Illuminate\Database\Eloquent\Collection|array
    {
        return Specialization::all();
    }

    public function getGenders(): \Illuminate\Database\Eloquent\Collection|array
    {
        return Gender::all();
    }


}
