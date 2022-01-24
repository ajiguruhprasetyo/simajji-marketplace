<?php

namespace App\Repositories\Product;

use App\Models\ProductCategory;

class ProductCategoryRepository
{
    private $productCategory;

    public function __construct(ProductCategory $productCategory)
    {
        $this->page = 10;
        $this->productCategory = $productCategory;
    }

    public function getData(){
        $data = $this->productCategory;
        $data = $data->where('status', 'active');
        $data = $data->orderByDesc('created_at')->paginate($this->page);
        return $data;
    }

    public function storeData($request){
        $data = new $this->productCategory;
        $data->name_category = $request->name_category;
        $data->status = 'active';
        $data->save();
        return $data;
    }

    public function updateData($request,$id){
        $data = $this->productCategory->find($id);
        $data->name_category = $request->name_category;
        $data->update();
        return $data;
    }

    public function showData($id){
        return $this->productCategory->find($id);
    }

    public function active($id){
        $data = $this->productCategory->find($id);
        $data->status = 'active';
        $data->update();
        return $data;
    }

    public function inactive($id){
        $data = $this->productCategory->find($id);
        $data->status = 'inactive';
        $data->update();
        return $data;
    }


}
