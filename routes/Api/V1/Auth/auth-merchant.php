<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthMerchantController;

Route::post('auth/register-merchant', [AuthMerchantController::class, 'register']);
Route::post('auth/login-merchant', [AuthMerchantController::class, 'login']);
