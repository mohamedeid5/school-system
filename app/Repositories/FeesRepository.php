<?php

namespace App\Repositories;

use App\Interfaces\FeesRepositoryInterface;
use App\Models\Classroom;
use App\Models\Fee;
use App\Models\FeeType;
use App\Models\Grade;


class FeesRepository implements FeesRepositoryInterface
{
    public function index()
    {
        $fees = Fee::all();

        return view('pages.fees.index', compact('fees'));
    }

    public function create()
    {
        $grades = $this->getAllGrades();
        $classrooms = $this->getAllClassrooms();
        $types = $this->getFeesType();

        return view('pages.fees.create', compact('grades', 'classrooms', 'types'));
    }

    public function store($request)
    {

        $translations = [
            'en' => $request->title_en,
            'ar' => $request->title_ar
        ];

        Fee::create([
            'title' => $translations,
            'amount' => $request->amount,
            'grade_id' => $request->grade_id,
            'classroom_id' => $request->classroom_id,
            'description' => $request->description,
            'year' => $request->year,
            'fee_type_id' => $request->fee_type_id,
        ]);

        return redirect()->route('fees.index');
    }


    public function edit($id)
    {
        $fee = Fee::find($id);
        $grades = $this->getAllGrades();
        $classrooms = $this->getAllClassrooms();
        $types = $this->getFeesType();

        return view('pages.fees.edit', compact('fee', 'grades', 'classrooms', 'types'));
    }

    public function update($request, $id)
    {
        $fee = Fee::find($id);

        $translations = [
            'en' => $request->title_en,
            'ar' => $request->title_ar
        ];

        $fee->update([
            'title' => $translations,
            'amount' => $request->amount,
            'grade_id' => $request->grade_id,
            'classroom_id' => $request->classroom_id,
            'description' => $request->description,
            'year' => $request->year,
            'fee_type_id' => $request->fee_type_id,
        ]);

        return redirect()->back();
    }

    public function destroy($id)
    {
        $fee = Fee::find($id);

        $fee->delete();

        return redirect()->back();
    }

    public function getAllGrades()
    {
        return Grade::all();
    }

    public function getAllClassrooms()
    {
        return Classroom::all();
    }

    public function getFeesType()
    {
        return FeeType::all();
    }
}
