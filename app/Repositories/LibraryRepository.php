<?php

namespace App\Repositories;

use App\Http\Controllers\FileController;
use App\Interfaces\LibraryRepositoryInterface;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Library;
use App\Models\Section;
use App\Models\Teacher;

class LibraryRepository implements LibraryRepositoryInterface
{

    public function index()
    {
        $books = Library::all();

        return view('pages.library.index', compact('books'));
    }

    public function create()
    {
        $teachers = Teacher::all();
        $grades = Grade::all();
        $classrooms = Classroom::all();
        $sections = Section::all();

        return view('pages.library.create', compact('teachers', 'grades', 'classrooms', 'sections'));
    }

    public function store($request)
    {
        Library::create([
           'title' => $request->title,
           'grade_id' => $request->grade_id,
           'classroom_id' => $request->classroom_id,
           'section_id' => $request->section_id,
           'teacher_id' => $request->section_id,
           'file_name' => $request->file_name->getClientOriginalName(),
        ]);

        FileController::upload($request->file_name, 'library/' . $request->teacher_id, $request->file_name->getClientOriginalName());

        return redirect()->route('library.index');
    }

    public function edit($id)
    {
        $book = Library::findOrFail($id);

        $teachers = Teacher::all();
        $grades = Grade::all();
        $classrooms = Classroom::all();
        $sections = Section::all();

        return view('pages.library.edit', compact('book','teachers', 'grades', 'classrooms', 'sections'));
    }

    public function update($request, $id)
    {
        $book = Library::findOrFail($id);

        $book->title = $request->title;
        $book->grade_id = $request->grade_id;
        $book->classroom_id = $request->classroom_id;
        $book->section_id = $request->section_id;
        $book->teacher_id = $request->teacher_id;

        if ($request->hasFile('file_name')) {

            FileController::deleteFile('library/' . $book->teacher_id . '/' . $book->file_name);

            FileController::upload($request->file_name, 'library/' . $request->teacher_id, $request->file_name->getClientOriginalName());

            $book->file_name = $request->file_name->getClientOriginalName();

        }

        $book->file_name = $book->file_name;

        $book->save();



        return redirect()->back();

    }

    public function destroy($id)
    {
        $book = Library::findOrFail($id);
        $book->delete();

        FileController::deleteDirectory('library/' . $book->teacher_id);

        return redirect()->route('library.index');
    }

    public function downloadAttachment($fileName)
    {
        $book = Library::where('file_name', $fileName)->first();

        return FileController::downloadFile('library/' . $book->teacher_id . '/' . $fileName);
    }
}
