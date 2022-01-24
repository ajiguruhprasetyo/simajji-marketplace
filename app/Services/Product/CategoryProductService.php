<?php

namespace App\Services\Product;

use App\Repositories\Product\ProductCategoryRepository;

class CategoryProductService
{
    private $repoProductCategory;
    public function __construct(ProductCategoryRepository $repoProductCategory)
    {
        $this->repoProductCategory = $repoProductCategory;
    }

    public function getProductCategory()
    {
        try {
            $data =  $this->repoProductCategory->getData();
            return response()->json(['message' => true, 'data' =>$data]);
        } catch (\Throwable $e){
            return response()->json(['message' => true, 'data' =>$e->getMessage()]);
        }
    }

    public function storeData($request)
    {
        try {
            $data =  $this->repoProductCategory->storeData($request);
            return response()->json(['message' => true, 'data' =>$data]);
        } catch (\Throwable $e){
            return response()->json(['message' => true, 'data' =>$e->getMessage()]);
        }
    }

    public function updateData($request,$id)
    {
        try {
            $data =  $this->repoProductCategory->updateData($request,$id);
            return response()->json(['message' => true, 'data' =>$data]);
        } catch (\Throwable $e){
            return response()->json(['message' => true, 'data' =>$e->getMessage()]);
        }
    }

    public function showData($id)
    {
        try {
            $data =  $this->repoProductCategory->showData($id);
            return response()->json(['message' => true, 'data' =>$data]);
        } catch (\Throwable $e){
            return response()->json(['message' => true, 'data' =>$e->getMessage()]);
        }
    }

    public function active($id)
    {
        try {
            $data =  $this->repoProductCategory->active($id);
            return response()->json(['message' => true, 'data' =>$data]);
        } catch (\Throwable $e){
            return response()->json(['message' => true, 'data' =>$e->getMessage()]);
        }
    }

    public function inactive($id)
    {
        try {
            $data =  $this->repoProductCategory->inactive($id);
            return response()->json(['message' => true, 'data' =>$data]);
        } catch (\Throwable $e){
            return response()->json(['message' => true, 'data' =>$e->getMessage()]);
        }
    }

}
