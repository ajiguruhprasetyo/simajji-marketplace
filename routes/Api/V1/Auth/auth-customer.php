<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthCustomerController;

Route::post('auth/register-customer', [AuthCustomerController::class, 'register']);
Route::post('auth/login-customer', [AuthCustomerController::class, 'login']);

