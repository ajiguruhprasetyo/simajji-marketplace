<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;

require ('Api/V1/Auth/auth-admin.php');
require ('Api/V1/Auth/auth-merchant.php');
require ('Api/V1/Auth/auth-customer.php');

Route::prefix('v1')->group( function () {

    Route::group(['middleware' => 'jwtapi'], function () {
        require ('Api/V1/Merchant/merchant.php');
        require ('Api/V1/Admin/admin.php');
        require ('Api/V1/Customer/customer.php');
    });

});


