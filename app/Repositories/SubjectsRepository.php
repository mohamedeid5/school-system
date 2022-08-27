<?php

namespace App\Repositories;

use App\Interfaces\SubjectsRepositoryInterface;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Subject;
use App\Models\Teacher;

class SubjectsRepository implements SubjectsRepositoryInterface
{

    public function index()
    {
        $subjects = Subject::all();

        return view('pages.subjects.index', compact('subjects'));
    }

    public function create()
    {
        $grades = Grade::all();
        $teachers = Teacher::all();

        return view('pages.subjects.create', compact('grades', 'teachers'));
    }

    public function store($request)
    {
        $translations = [
            'en' => $request->name_en,
            'ar' => $request->name_ar
        ];

        Subject::create([
           'name' => $translations,
            'grade_id' => $request->grade_id,
            'classroom_id' => $request->classroom_id,
            'teacher_id' => $request->teacher_id,
        ]);

        return redirect()->route('subjects.index');
    }

    public function edit($id)
    {
        $subject = Subject::findOrFail($id);
        $grades = Grade::all();
        $teachers = Teacher::all();
        $classrooms = Classroom::all();

        return view('pages.subjects.edit', compact('subject', 'grades', 'teachers', 'classrooms'));
    }

    public function update($request, $id)
    {
        $translations = [
            'en' => $request->name_en,
            'ar' => $request->name_ar
        ];

        $subject = Subject::findOrFail($id);

        $subject->update([
            'name' => $translations,
            'grade_id' => $request->grade_id,
            'classroom_id' => $request->classroom_id,
            'teacher_id' => $request->teacher_id,
        ]);

        return redirect()->back();
    }

    public function destroy($id)
    {
        $subject = Subject::findOrFail($id);

        $subject->delete();

        return redirect()->route('subjects.index');
    }
}
