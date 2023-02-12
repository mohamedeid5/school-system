<?php

namespace App\Repositories;

use App\Http\Controllers\FileController;
use App\Interfaces\SettingsRepositoryInterface;
use App\Models\Setting;

class SettingsRepository implements SettingsRepositoryInterface
{

    public function index()
    {
        $collection = Setting::all();

        $setting = $collection->flatMap(function ($values){
           return [$values->key => $values->value];
        });

        return view('pages.settings.index', compact('setting'));
    }

    public function update($request)
    {
        $info = $request->except('_token', '_method', 'logo');

        foreach ($info as $key => $value) {
            Setting::where('key', $key)->update(['value' => $value]);
        }

        if ($request->hasFile('logo')) {

            $logo = Setting::where('key', 'logo')->first();
            FileController::deleteFile('settings/' .  $logo->value);

            Setting::where('key', 'logo')->update(['value' => $request->logo->getClientOriginalName()]);
            FileController::upload($request->logo, 'settings', $request->logo->getClientOriginalName());
        }

        return redirect()->back();
    }
}
