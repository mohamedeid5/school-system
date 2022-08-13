<?php

namespace App\Repositories;

use App\Interfaces\PromotionRepositoryInterface;
use App\Models\Grade;
use App\Models\Promotion;
use App\Models\Student;
use Illuminate\Support\Facades\DB;


class PromotionRepository implements PromotionRepositoryInterface
{

    public function index()
    {
        $grades = Grade::all();

        return view('pages.promotions.index', compact('grades'));
    }

    public function create()
    {
        $promotions = Promotion::all();

        return view('pages.promotions.manage', compact('promotions'));
    }


    public function store($request)
    {

        DB::beginTransaction();

        $students = Student::where('grade_id', $request->grade_id)
                    ->where('section_id', $request->section_id)
                    ->where('academic_year', $request->academic_year)
                    ->where('classroom_id', $request->classroom_id)
                    ->get();

        if ($students->count() < 1) {
            return redirect()->back()->withErrors('there\'s no students');
        }

        foreach ($students as $student) {

            $student->update([
                'grade_id' => $request->grade_id_new,
                'classroom_id' => $request->classroom_id_new,
                'section_id' => $request->section_id_new,
                'academic_year' => $request->academic_year_new,
            ]);


            Promotion::updateOrCreate([
                'student_id' => $student->id,
                'from_grade' => $request->grade_id,
                'from_section' => $request->section_id,
                'from_classroom' => $request->classroom_id,
                'to_grade' => $request->grade_id_new,
                'to_section' => $request->section_id_new,
                'to_classroom' => $request->classroom_id_new,
                'academic_year' => $request->academic_year,
                'academic_year_new' => $request->academic_year_new,
            ]);

        }

        DB::commit();

        return redirect()->back();

    }

    public function destroy($id)
    {

        DB::beginTransaction();


        if (request('page_id') == 1) {

            // delete all promotions

            $promotions = Promotion::all();

            foreach ($promotions as $promotion) {

                $promotion->student->update([
                    'grade_id' => $promotion->from_grade,
                    'classroom_id' => $promotion->from_classroom,
                    'section_id' => $promotion->from_section,
                    'academic_year' => $promotion->academic_year,
                ]);
            }

            Promotion::truncate();

        } else {

            // delete one promotion

            $promotion = Promotion::findOrFail($id);

            $promotion->student->update([
                'grade_id' => $promotion->from_grade,
                'classroom_id' => $promotion->from_classroom,
                'section_id' => $promotion->from_section,
                'academic_year' => $promotion->academic_year,
            ]);

            $promotion->delete();

        }

        DB::commit();

        return redirect()->back();

    }
}
