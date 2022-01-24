<?php

namespace App\Repositories\Merchant;

use App\Models\Merchant;
use App\Services\Jwt\AuthService;

class MerchantRepository
{
    private $merchant, $jwtService;

    public function __construct(Merchant $merchant, AuthService $jwtService)
    {
        $this->page = 10;
        $this->merchant = $merchant;
        $this->jwtService = $jwtService;
    }

    public function getData(){
        $data = $this->merchant::select('id','merchant_name','created_at');
        $data = $data->orderByDesc('created_at')->paginate($this->page);
        return $data;
    }

    public function storeData($request){
        $userId = $this->jwtService->userIdFromJwt();
        $data = new $this->merchant;
        $data->user_id = $userId;
        $data->merchant_name = $request->merchant_name;
        $data->created_by = $userId;
        $data->updated_by = $userId;
        $data->save();
        return $data;
    }

    public function updateData($request,$id){
        $userId = $this->jwtService->userIdFromJwt();
        $data = $this->merchant->find($id);
        $data->merchant_name = $request->merchant_name;
        $data->updated_by = $userId;
        $data->update();
        return $data;
    }

    public function showData($id){
        return $this->merchant::select('Merchants.id','Merchants.merchant_name','u.user_name','u.role' )
                ->leftJoin('Users as u','u.id','Merchants.user_id')
                ->where('Merchants.id',$id)->first();
    }


}
