<?php

namespace App\Services\Merchant;

use App\Repositories\Merchant\CustomerRepository;

class MerchantService
{
    private $merchantRepo;
    public function __construct(CustomerRepository $merchantRepo)
    {
        $this->merchantRepo = $merchantRepo;
    }

    public function getMerchant()
    {
        try {
            $data =  $this->merchantRepo->getData();
            return response()->json(['message' => true, 'data' => $data], 200);
        } catch (\Throwable $e){
            return response()->json(['message' => true, 'data' =>$e->getMessage()], 401);
        }
    }

    public function storeData($request)
    {
        try {
            $data =  $this->merchantRepo->storeData($request);
            return response()->json(['message' => true, 'data' => 'data has been created'], 200);
        } catch (\Throwable $e){
            return response()->json(['message' => true, 'data' =>$e->getMessage()], 401);
        }
    }

    public function updateData($request,$id)
    {
        try {
            $data =  $this->merchantRepo->updateData($request,$id);
            return response()->json(['message' => true, 'data' => 'data has been updated'], 200);
        } catch (\Throwable $e){
            return response()->json(['message' => true, 'data' =>$e->getMessage()], 401);
        }
    }

    public function showData($id)
    {
        try {
            $data =  $this->merchantRepo->showData($id);
            return response()->json(['message' => true, 'data' =>$data], 200);
        } catch (\Throwable $e){
            return response()->json(['message' => true, 'data' =>$e->getMessage()],401);
        }
    }

}
