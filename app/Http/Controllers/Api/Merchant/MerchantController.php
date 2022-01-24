<?php

namespace App\Http\Controllers\Api\Merchant;

use App\Http\Controllers\Controller;
use App\Services\Merchant\MerchantService;
use Illuminate\Http\Request;

class MerchantController extends Controller
{
    private $merchantService;

    public function __construct(MerchantService $merchantService){
        $this->merchantService = $merchantService;
    }

    public function index(){
        return $this->merchantService->getMerchant();
    }

    public function store(Request $request){
        return $this->merchantService->storeData($request);
    }

    public function update(Request $request,$id){
        return $this->merchantService->updateData($request,$id);
    }

    public function show($id){
        return $this->merchantService->showData($id);
    }


}
