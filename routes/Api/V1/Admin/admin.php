<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\ProductCategoryController;
use App\Http\Controllers\Api\Admin\MerchantController;
use App\Http\Controllers\Api\Admin\CustomerController;


Route::prefix('admin')->group(function ($routes) {
    //merchant
    $routes->get('merchant', [MerchantController::class,'index']);
    $routes->get('merchant/detail/{id}', [MerchantController::class,'detail']);
    //customer
    $routes->get('customer', [CustomerController::class,'index']);
    $routes->get('customer/detail/{id}', [CustomerController::class,'detail']);
    //category product
    $routes->get('product/category', [ProductCategoryController::class,'index']);
    $routes->post('product/category/store', [ProductCategoryController::class,'store']);
    $routes->patch('product/category/update/{id}', [ProductCategoryController::class,'update']);
    $routes->get('product/category/show/{id}', [ProductCategoryController::class,'show']);
    $routes->get('product/category/active/{id}', [ProductCategoryController::class,'active']);
    $routes->get('product/category/inactive/{id}', [ProductCategoryController::class,'inactive']);
});
