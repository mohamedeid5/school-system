<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Interfaces\StudentRepositoryInterface;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentsController extends Controller
{

    public StudentRepositoryInterface $studentRepository;

    public function __construct(StudentRepositoryInterface $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $students = $this->studentRepository->getAllStudents();

        return view('pages.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genders = $this->studentRepository->getGenders();
        $nationalities = $this->studentRepository->getNationalities();
        $bloods = $this->studentRepository->getBloods();
        $classrooms = $this->studentRepository->getClassrooms();
        $parents = $this->studentRepository->getParents();
        $grades = $this->studentRepository->getGrades();

        return view('pages.students.create', compact('genders', 'nationalities', 'bloods', 'classrooms', 'parents', 'grades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentRequest $request)
    {
        return $this->studentRepository->createStudent($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = $this->studentRepository->getStudentById($id);

        return view('pages.students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = $this->studentRepository->editStudent($id);
        $genders = $this->studentRepository->getGenders();
        $nationalities = $this->studentRepository->getNationalities();
        $bloods = $this->studentRepository->getBloods();
        $classrooms = $this->studentRepository->getClassrooms();
        $parents = $this->studentRepository->getParents();
        $grades = $this->studentRepository->getGrades();
        $sections = $this->studentRepository->getAllSections();

        return view('pages.students.edit', compact('student', 'genders', 'nationalities', 'bloods', 'classrooms', 'parents', 'grades', 'sections'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->studentRepository->updateStudent($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->studentRepository->deleteStudent($id);
    }


    public function getSections($id)
    {
        return $this->studentRepository->getSections($id);
    }

    public function uploadAttachments(Request $request)
    {
        return $this->studentRepository->uploadAttachments($request);
    }

    public function deleteAttachment(Request $request)
    {
        return $this->studentRepository->deleteAttachment($request);
    }

    public function downloadAttachment($id, $name)
    {
        return $this->studentRepository->downloadAttachment($id, $name);
    }
}
