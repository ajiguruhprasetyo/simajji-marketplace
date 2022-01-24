<?php

namespace App\Http\Controllers\Api\Merchant\Profile;

use App\Http\Controllers\Controller;
use App\Services\Merchant\MerchantService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    private $merchantService;

    public function __construct(MerchantService $merchantService){
        $this->merchantService = $merchantService;
    }

    public function profile($id){
        return $this->merchantService->showData($id);
    }

    public function updateProfile(Request $request,$id){
        return $this->merchantService->updateData($request,$id);
    }


}
