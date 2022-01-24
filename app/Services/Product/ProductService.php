<?php

namespace App\Services\Product;

use App\Repositories\Product\ProductRepository;

class ProductService
{
    private $repoProduct;
    public function __construct(ProductRepository $repoProduct)
    {
        $this->repoProduct = $repoProduct;
    }

    public function getProduct()
    {
        try {
            $data =  $this->repoProduct->getData();
            return response()->json(['message' => true, 'data' =>$data]);
        } catch (\Throwable $e){
            return response()->json(['message' => true, 'data' =>$e->getMessage()]);
        }
    }

    public function storeData($request)
    {
        try {
            $data =  $this->repoProduct->storeData($request);
            return response()->json(['message' => true, 'data' => 'data has ben created']);
        } catch (\Throwable $e){
            return response()->json(['message' => true, 'data' =>$e->getMessage()]);
        }
    }

    public function updateData($request,$id)
    {
        try {
            $data =  $this->repoProduct->updateData($request,$id);
            return response()->json(['message' => true, 'data' => 'data has ben updated']);
        } catch (\Throwable $e){
            return response()->json(['message' => true, 'data' =>$e->getMessage()]);
        }
    }

    public function showData($id)
    {
        try {
            $data =  $this->repoProduct->showData($id);
            return response()->json(['message' => true, 'data' =>$data]);
        } catch (\Throwable $e){
            return response()->json(['message' => true, 'data' =>$e->getMessage()]);
        }
    }

    public function active($id)
    {
        try {
            $data =  $this->repoProduct->active($id);
            return response()->json(['message' => true, 'data' => 'product has actived']);
        } catch (\Throwable $e){
            return response()->json(['message' => true, 'data' =>$e->getMessage()]);
        }
    }

    public function inactive($id)
    {
        try {
            $data =  $this->repoProduct->inactive($id);
            return response()->json(['message' => true, 'data' => 'product has inactived']);
        } catch (\Throwable $e){
            return response()->json(['message' => true, 'data' =>$e->getMessage()]);
        }
    }

}
