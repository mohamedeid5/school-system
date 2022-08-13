<?php

namespace App\Interfaces;

interface PromotionRepositoryInterface
{
    public function index();
    public function create();
    public function store($request);
    public function destroy($id);

}
