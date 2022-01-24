<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Services\Customer\CustomerService;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    private $customerService;

    public function __construct(CustomerService $customerService){
        $this->customerService = $customerService;
    }

    public function update(Request $request,$id){
        return $this->customerService->updateData($request,$id);
    }

    public function show($id){
        return $this->customerService->showData($id);
    }


}
