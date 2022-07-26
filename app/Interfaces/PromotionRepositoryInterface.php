<?php

namespace App\Interfaces;

interface PromotionRepositoryInterface
{
    public function index();
    public function createPromotion($studentDetails);
    public function editPromotion($studentId);
    public function updatePromotion($studentDetails, $studentId);
    public function getPromotionById($studentId);

}
