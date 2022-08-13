<?php

namespace App\Repositories;

use App\Interfaces\GraduatesRepositoryInterface;
use App\Models\Grade;
use App\Models\Promotion;
use App\Models\Student;
use Illuminate\Support\Facades\DB;


class GraduatesRepository implements GraduatesRepositoryInterface
{


    public function index()
    {
        $students = Student::onlyTrashed()->get();

        return view('pages.graduates.index', compact('students'));
    }

    public function create()
    {

        $grades = Grade::all();

        return view('pages.graduates.create', compact('grades'));
    }


    public function softDelete($request)
    {
        $students = Student::where('grade_id', $request->grade_id)
                            ->where('classroom_id', $request->classroom_id)
                            ->where('section_id', $request->section_id)
                            ->get();

        if ($students->count() < 1) {
            return redirect()->back()->withErrors('no students found');
        }

        foreach ($students as $student) {
            $student->delete();
        }

        return redirect()->back();
    }

    public function returnStudent($id)
    {
        Student::onlyTrashed()->where('id', $id)->restore();

        return redirect()->back();
    }

    public function destroy($id)
    {
        Student::onlyTrashed()->where('id', $id)->forceDelete();

        return redirect()->back();
    }
}
