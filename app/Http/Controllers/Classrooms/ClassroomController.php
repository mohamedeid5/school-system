<?php

namespace App\Http\Controllers\Classrooms;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClassroomUpdateRequest;
use App\Http\Requests\StoreClassroomRequest;
use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $classrooms = Classroom::all();

        $grades = Grade::all();

        return view('pages.classrooms.index', compact('classrooms', 'grades'));
    }

    /**
     * @param StoreClassroomRequest $request
     * @param Classroom $classroom
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreClassroomRequest $request)
    {

        try {

            foreach ($request->list_classes as $list_class) {

                $classroom = new Classroom();

                $translations = [
                    'en' => $list_class['name_en'],
                    'ar' => $list_class['name']
                ];

                $classroom->setTranslations('name', $translations);

                $classroom->grade_id = $list_class['grade_id'];

                $classroom->save();
            }

            toastr()->success(__('messages.success'));

            return redirect()->route('classrooms.index');

        } catch (\Exception $exception) {
            return redirect()->back()->withErrors(['error' => $exception->getMessage()]);
        }

    }

    /**
     * @param Classroom $classroom
     * @param ClassroomUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Classroom $classroom, ClassroomUpdateRequest $request)
    {

        $translations = [
            'en' => $request->name_en,
            'ar' => $request->name
        ];

        $classroom->setTranslations('name', $translations);

        $classroom->grade_id = $request->grade_id;

        $classroom->save();

        toastr()->success(__('messages.update'));

        return redirect()->route('classrooms.index');

    }

    /**
     * @param Classroom $classroom
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Classroom $classroom)
    {

        $classroom->destroy($classroom->id);

        toastr()->success(__('messages.deleteSelenium'));

        return redirect()->back();
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteAll()
    {

        $ids = explode(',', request('delete_all_id'));

        Classroom::whereIn('id', $ids)->delete();

        toastr()->success(__('messages.delete'));

        return redirect()->back();

    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function filterClasses(Request $request)
    {
        $grades = Grade::all();

        $search = Classroom::select('*')->where('grade_id', '=', $request->grade_id)->get();

        return view('pages.classrooms.index', compact('grades'))->withDetails($search);
    }
}
