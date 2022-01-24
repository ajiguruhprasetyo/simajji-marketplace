<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Services\Merchant\MerchantService;

class MerchantController extends Controller
{
    private $merchantService;

    public function __construct(MerchantService $merchantService){
        $this->merchantService = $merchantService;
    }

    public function index(){
        return $this->merchantService->getMerchant();
    }

    public function detail($id){
        return $this->merchantService->showData($id);
    }


}
