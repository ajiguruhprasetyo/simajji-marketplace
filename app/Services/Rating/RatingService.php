<?php

namespace App\Services\Rating;

use App\Repositories\Rating\RatingRepository;

class RatingService
{
    private $repoRating;

    public function __construct(RatingRepository $repoRating)
    {
        $this->repoRating = $repoRating;
    }

    public function rating($request)
    {
        try {
            $data = $this->repoRating->rating($request);
            return response()->json(['message' => true, 'data' => ($data == true ? 'rating has been submit' : 'rating not be edited')], 200);
        } catch (\Throwable $e){
            return response()->json(['message' => false, 'data' => $e->getMessage()], 401);
        }
    }

    public function productRating($productId)
    {
        try {
            $data = $this->repoRating->ratingProduct($productId);
            return response()->json(['message' => true, 'data' => $data], 200);
        } catch (\Throwable $e){
            return response()->json(['message' => false, 'data' => $e->getMessage()], 401);
        }
    }


}
