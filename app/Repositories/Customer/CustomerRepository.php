<?php

namespace App\Repositories\Customer;

use App\Models\Customer;
use App\Services\UploadImage\UploadImageService;
class CustomerRepository
{
    private $customer, $uploadImageService;

    public function __construct(Customer $customer, UploadImageService $uploadImageService)
    {
        $this->page = 10;
        $this->customer = $customer;
        $this->uploadImageService = $uploadImageService;
    }

    public function getData(){
        $data = $this->customer::select('id','name','email','phone','address','image','created_at');
        $data = $data->orderByDesc('created_at')->paginate($this->page);
        return $data;
    }

    public function storeData($request){
        $nameStorage = 'Image/customer/';
        $data = new $this->customer;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        if (!empty($request->image) ) {
            $nameImage = $this->uploadImageService->imageProcessingStore($nameStorage, $request->image);
            $data->image = $nameImage;
        }
        $data->status = 'active';
        $data->save();
        return $data;
    }

    public function updateData($request,$id){
        $nameStorage = 'Image/customer/';
        $data = $this->customer->find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
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
        return $this->customer::select('id','name','email','phone','address','image','created_at')->find($id);
    }


}
