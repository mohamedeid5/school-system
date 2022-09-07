<?php

namespace App\Repositories;

use App\Interfaces\QuizRepositoryInterface;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Quiz;
use App\Models\Section;
use App\Models\Subject;
use App\Models\Teacher;

class QuizRepository implements QuizRepositoryInterface
{

    public function index()
    {
        $quizzes = Quiz::all();

        return view('pages.quizzes.index', compact('quizzes'));
    }

    public function create()
    {
        $subjects = Subject::all();
        $teachers = Teacher::all();
        $grades = Grade::all();
        $classrooms = Classroom::all();
        $sections = Section::all();


        return view('pages.quizzes.create', compact('subjects', 'teachers', 'grades', 'classrooms', 'sections'));
    }

    public function store($request)
    {
        $translation = [
          'en' => $request->name_en,
          'ar' => $request->name_ar,
        ];

        Quiz::create([
           'name' => $translation,
           'subject_id' => $request->subject_id,
           'teacher_id' => $request->teacher_id,
           'grade_id' => $request->grade_id,
           'classroom_id' => $request->classroom_id,
           'section_id' => $request->section_id,
        ]);

        return redirect()->route('quizzes.index');
    }

    public function show($id)
    {
        // TODO: Implement show() method.
    }

    public function edit($id)
    {
        $quiz = Quiz::findOrFail($id);
        $subjects = Subject::all();
        $teachers = Teacher::all();
        $grades = Grade::all();
        $classrooms = Classroom::all();
        $sections = Section::all();

        return view('pages.quizzes.edit', compact('quiz', 'subjects', 'teachers', 'grades', 'classrooms', 'sections'));
    }

    public function update($request, $id)
    {
        $translation = [
            'en' => $request->name_en,
            'ar' => $request->name_ar,
        ];

        $quiz = Quiz::findOrFail($id);

        $quiz->update([
            'name' => $translation,
            'subject_id' => $request->subject_id,
            'teacher_id' => $request->teacher_id,
            'grade_id' => $request->grade_id,
            'classroom_id' => $request->classroom_id,
            'section_id' => $request->section_id,
        ]);

        return redirect()->back();
    }

    public function destroy($id)
    {
        $exam = Quiz::findOrFail($id);
        $exam->delete();

        return redirect()->route('quizzes.index');
    }
}
