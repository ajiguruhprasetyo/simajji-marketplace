<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthAdminController;

Route::post('auth/register-admin', [AuthAdminController::class, 'register']);
Route::post('auth/login-admin', [AuthAdminController::class, 'login']);
//Route::post('auth/logout', [AuthController::class, 'logout']);
//Route::post('auth/refresh', [AuthController::class, 'refresh']);
