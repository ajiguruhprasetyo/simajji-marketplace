<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Merchant\Profile\ProfileController;
use App\Http\Controllers\Api\Merchant\Product\ProductController;
use App\Http\Controllers\Api\Merchant\Product\RatingController;

Route::prefix('merchant')->group(function ($routes) {
    //merchant profile
    $routes->get('/profile/{id}', [ProfileController::class,'profile']);
    $routes->patch('/profile/update/{id}', [ProfileController::class,'updateProfile']);
    //product
    $routes->get('product', [ProductController::class,'index']);
    $routes->post('product/store', [ProductController::class,'store']);
    $routes->post('product/update/{id}', [ProductController::class,'update']);
    $routes->get('product/show/{id}', [ProductController::class,'show']);
    $routes->get('product/active/{id}', [ProductController::class,'active']);
    $routes->get('product/inactive/{id}', [ProductController::class,'inactive']);
    //product rating

    $routes->get('product/rating/{productId}', [RatingController::class,'list']);
});
