<?php

namespace App\Interfaces;

interface AttendanceRepositoryInterface
{
    public function index();
    public function store($request);
    public function show($id);
}
