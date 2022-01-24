<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Services\UploadImage\UploadImageService;

class ProductRepository
{
    private $product, $uploadImageService;

    public function __construct(Product $product, UploadImageService $uploadImageService)
    {
        $this->page = 10;
        $this->product = $product;
        $this->uploadImageService = $uploadImageService;
    }

    public function getData(){
        $data = $this->product;
        $data = $data->where('status', 'active');
        $data = $data->orderByDesc('created_at')->paginate($this->page);
        return $data;
    }

    public function storeData($request){
        $nameStorage = 'Image/product/';
        $data = new $this->product;
        $data->name_product = $request->name_product;
        $data->merchant_id = $request->merchant_id;
        $data->product_category_id = $request->product_category_id;
        $data->stock = $request->stock;
        $data->price = $request->price;
        $data->unit = $request->unit;
        if (!empty($request->image) ) {
            $nameImage = $this->uploadImageService->imageProcessingStore($nameStorage, $request->image);
            $data->image = $nameImage;
        }
        $data->status = 'active';
        $data->save();
        return $data;
    }

    public function updateData($request,$id){
        $nameStorage = 'Image/product/';
        $data = $this->product->find($id);
        $data->name_product = $request->name_product;
        $data->merchant_id = $request->merchant_id;
        $data->product_category_id = $request->product_category_id;
        $data->stock = $request->stock;
        $data->price = $request->price;
        $data->unit = $request->unit;
        if (!empty($data->image)) {
            if (empty($request->image)) {
                $data->image = $data->image;
            } else {
                $nameImage = $this->uploadImageService->imageProcessingUpdate($nameStorage, $data->image, $request->image);
                $data->image = $nameImage;
            }
        }
        $data->update();
        return $data;
    }

    public function showData($id){
        return $this->product->find($id);
    }

    public function active($id){
        $data = $this->product->find($id);
        $data->status = 'active';
        $data->update();
        return $data;
    }

    public function inactive($id){
        $data = $this->product->find($id);
        $data->status = 'inactive';
        $data->update();
        return $data;
    }


}
