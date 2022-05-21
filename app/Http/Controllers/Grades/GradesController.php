<?php

namespace App\Http\Controllers\Grades;

use App\Models\Grade;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGradeRequest;

class GradesController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $grades = Grade::all();

        return view('pages.grades.index', compact('grades'));
    }

    /**
     * @param StoreGradeRequest $request
     * @param Grade $grade
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreGradeRequest $request, Grade $grade)
    {
        $validated = $request->validated();

        $translations = [
            'en' => $request->name_en,
            'ar' => $request->name
        ];

        $grade->setTranslations('name', $translations);

        $grade->notes = $request->notes;

        $grade->save();

        toastr()->success(__('messages.success'));

        return redirect()->route('grades.index');
    }

    /**
     * @param Grade $grade
     * @param StoreGradeRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Grade $grade, StoreGradeRequest $request)
    {

        $translations = [
            'en' => $request->name_en,
            'ar' => $request->name
        ];

        $grade->setTranslations('name', $translations);

        $grade->notes = $request->notes;

        $grade->save();

        toastr()->success(__('messages.update'));

        return redirect()->route('grades.index');
    }

    /**
     * @param Grade $grade
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Grade $grade)
    {
        if(count($grade->classrooms) > 0) {

            toastr()->error(__('messages.fail_delete'));

            return back();
        }

        $grade->destroy($grade->id);

        toastr()->success(__('messages.delete'));

        return redirect()->back();
    }
}
