<?php

namespace App\Http\Controllers\Promotions;

use App\Http\Controllers\Controller;
use App\Interfaces\PromotionRepositoryInterface;
use Illuminate\Http\Request;

class PromotionsController extends Controller
{
    private PromotionRepositoryInterface $promotionRepository;

    public function __construct(PromotionRepositoryInterface $promotionRepository)
    {
        $this->promotionRepository = $promotionRepository;
    }

    public function index()
    {
        return $this->promotionRepository->index();
    }
}
