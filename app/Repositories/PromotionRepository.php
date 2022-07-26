<?php

namespace App\Repositories;

use App\Interfaces\PromotionRepositoryInterface;
use App\Models\Grade;


class PromotionRepository implements PromotionRepositoryInterface
{


    public function index()
    {
        $grades = Grade::all();

        return view('pages.promotions.index');
    }

    public function createPromotion($studentDetails)
    {
        // TODO: Implement createPromotion() method.
    }

    public function editPromotion($studentId)
    {
        // TODO: Implement editPromotion() method.
    }

    public function updatePromotion($studentDetails, $studentId)
    {
        // TODO: Implement updatePromotion() method.
    }

    public function getPromotionById($studentId)
    {
        // TODO: Implement getPromotionById() method.
    }
}
