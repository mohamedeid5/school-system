<?php

namespace App\Repositories;

use App\Interfaces\FeesTypeRepositoryInterface;
use App\Models\FeeType;


class FeesTypeRepository implements FeesTypeRepositoryInterface
{
    public function index()
    {
        $types = FeeType::all();

        return view('pages.fees.types.index', compact('types'));
    }

    public function create()
    {
        return view('pages.fees.types.create');
    }

    public function store($request)
    {

        $translations = [
            'en' => $request->title_en,
            'ar' => $request->title_ar
        ];

        FeeType::create([
            'title' => $translations
        ]);

        return redirect()->route('fees-type.index');
    }


    public function edit($id)
    {
        $type = FeeType::find($id);

        return view('pages.fees.types.edit', compact('type'));
    }

    public function update($request, $id)
    {
        $type = FeeType::find($id);

        $translations = [
            'en' => $request->title_en,
            'ar' => $request->title_ar
        ];

        $type->update([
            'title' => $translations,
        ]);

        return redirect()->back();
    }

    public function destroy($id)
    {
        $type = FeeType::find($id);

        $type->delete();

        return redirect()->back();
    }


}
