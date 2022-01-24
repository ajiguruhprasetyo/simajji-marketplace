<?php

namespace App\Services\Customer;

use App\Repositories\Customer\CustomerRepository;

class CustomerService
{
    private $customerRepo;
    public function __construct(CustomerRepository $customerRepo)
    {
        $this->customerRepo = $customerRepo;
    }

    public function getData()
    {
        try {
            $data =  $this->customerRepo->getData();
            return response()->json(['message' => true, 'data' => $data], 200);
        } catch (\Throwable $e){
            return response()->json(['message' => false, 'data' =>$e->getMessage()], 401);
        }
    }

    public function storeData($request)
    {
        try {
            $data =  $this->customerRepo->storeData($request);
            return response()->json(['message' => true, 'data' => 'data has been created'], 200);
        } catch (\Throwable $e){
            return response()->json(['message' => false, 'data' =>$e->getMessage()], 401);
        }
    }

    public function updateData($request,$id)
    {
        try {
            $data =  $this->customerRepo->updateData($request,$id);
            return response()->json(['message' => true, 'data' => 'data has been updated'], 200);
        } catch (\Throwable $e){
            return response()->json(['message' => false, 'data' =>$e->getMessage()], 401);
        }
    }

    public function showData($id)
    {
        try {
            $data =  $this->customerRepo->showData($id);
            return response()->json(['message' => true, 'data' =>$data], 200);
        } catch (\Throwable $e){
            return response()->json(['message' => false, 'data' =>$e->getMessage()],401);
        }
    }

}
