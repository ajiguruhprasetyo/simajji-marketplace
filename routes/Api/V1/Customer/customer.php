<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Customer\CustomerController;
use App\Http\Controllers\Api\Customer\TransactionController;
use App\Http\Controllers\Api\Customer\RatingController;

Route::prefix('customer')->group(function ($routes) {
    $routes->post('/profile/update/{id}', [CustomerController::class,'update']);
    $routes->get('/profile/{id}', [CustomerController::class,'show']);

    //transaction
    $routes->get('/transaction/list', [TransactionController::class,'listTransaction']);
    $routes->post('/transaction', [TransactionController::class,'transactionWaitingPayment']);
    $routes->post('/transaction/confirm-payment/{id}', [TransactionController::class,'transactionConfirmPayment']);
    $routes->post('/transaction/success/{id}', [TransactionController::class,'transactionSuccess']);
    $routes->post('/transaction/reject/{id}', [TransactionController::class,'transactionReject']);

    //ratings
    $routes->post('/rating', [RatingController::class,'rating']);
});
