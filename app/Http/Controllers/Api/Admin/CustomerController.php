<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Services\Customer\CustomerService;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    private $customerService;

    public function __construct(CustomerService $customerService){
        $this->customerService = $customerService;
    }

    public function index(){
        return $this->customerService->getData();
    }

    public function detail($id){
        return $this->customerService->showData($id);
    }


}
