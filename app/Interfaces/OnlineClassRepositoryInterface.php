<?php

namespace App\Interfaces;

interface OnlineClassRepositoryInterface
{
    public function index();
    public function create();
    public function indirectCreate();
    public function store($request);
    public function indirectStore($request);
    public function destroy($id);
}
