<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Services\Rating\RatingService;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    private $ratingService;

    public function __construct(RatingService $ratingService){
        $this->ratingService = $ratingService;
    }


    public function rating(Request $request){
        return $this->ratingService->rating($request);
    }

}
