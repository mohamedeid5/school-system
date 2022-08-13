<?php

namespace App\Interfaces;

interface GraduatesRepositoryInterface
{
    public function index();
    public function create();
    public function softDelete($request);
    public function returnStudent($id);
    public function destroy($id);

}
