<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Interfaces\TeacherRepositoryInterface;
use Illuminate\Http\Response;
use Illuminate\View\View;

class TeachersController extends Controller
{

    private TeacherRepositoryInterface $teacherRepository;

    public function __construct(TeacherRepositoryInterface $teacherRepository)
    {
        $this->teacherRepository = $teacherRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $teachers = $this->teacherRepository->getAllTeachers();

        return view('pages.teachers.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $specializations = $this->teacherRepository->getSpecializations();
        $genders = $this->teacherRepository->getGenders();

        return view('pages.teachers.create', compact('specializations', 'genders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(StoreTeacherRequest $request)
    {
        return $this->teacherRepository->createTeacher($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $teacher = $this->teacherRepository->editTeacher($id);
        $specializations = $this->teacherRepository->getSpecializations();
        $genders = $this->teacherRepository->getGenders();

        return view('pages.teachers.edit', compact('teacher', 'specializations', 'genders'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $id
     * @return Response
     */
    public function update(UpdateTeacherRequest $request, int $id)
    {
        return $this->teacherRepository->updateTeacher($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        return $this->teacherRepository->deleteTeacher($id);
    }
}
