<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Interfaces\SettingsRepositoryInterface;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    private SettingsRepositoryInterface $settingsRepository;

    public function __construct(SettingsRepositoryInterface $settingsRepository)
    {
        $this->settingsRepository = $settingsRepository;
    }

    public function index()
    {
        return $this->settingsRepository->index();
    }

    public function update(Request $request)
    {
        return $this->settingsRepository->update($request);
    }
}
