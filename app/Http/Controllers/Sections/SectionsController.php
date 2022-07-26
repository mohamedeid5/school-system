<?php

namespace App\Http\Controllers\Sections;

use App\Http\Controllers\Controller;
use App\Http\Requests\SectionsRequest;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $grades = Grade::with('sections')->get();
        $teachers = Teacher::all();

        return view('pages.sections.index', compact('grades', 'teachers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SectionsRequest $request, Section $section)
    {

        $translations = [
            'en' => $request->name_en,
            'ar' => $request->name
        ];

        $section->setTranslations('name', $translations);

        $section->grade_id = $request->grade_id;

        $section->classroom_id = $request->classroom_id;

        $section->status = 1;

        $section->save();

        // attach teachers to section
        $section->teachers()->attach($request->teacher_id);

        toastr()->success(__('messages.success'));

        return redirect()->route('sections.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SectionsRequest $request, Section $section)
    {

         $translations = [
            'en' => $request->name_en,
            'ar' => $request->name
        ];

        $section->setTranslations('name', $translations);

        $section->grade_id = $request->grade_id;

        $section->classroom_id = $request->classroom_id;

        $section->status = $request->status;

        $section->save();

        $section->teachers()->sync($request->teacher_id);

        toastr()->success(__('messages.success'));

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Section $section)
    {
        $section->delete();

        toastr()->success(__('messages.delete'));

        return redirect()->back();
    }

    public function getClasses($id)
    {
        $classes_list = Classroom::where('grade_id', $id)->pluck('name', 'id');

        return $classes_list;
    }
}
