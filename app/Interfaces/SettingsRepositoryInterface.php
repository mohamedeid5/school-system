<?php

namespace App\Interfaces;

interface SettingsRepositoryInterface
{
    public function index();
    public function update($request);
}
