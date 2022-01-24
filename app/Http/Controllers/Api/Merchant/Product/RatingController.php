<?php

namespace App\Http\Controllers\Api\Merchant\Product;

use App\Http\Controllers\Controller;
use App\Services\Rating\RatingService;


class RatingController extends Controller
{
    private $ratingService;

    public function __construct(RatingService $ratingService){
        $this->ratingService = $ratingService;
    }


    public function list($productId){
        return $this->ratingService->productRating($productId);
    }

}
