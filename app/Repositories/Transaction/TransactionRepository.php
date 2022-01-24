<?php

namespace App\Repositories\Transaction;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionPayment;
use App\Services\Jwt\AuthService;
use App\Services\UploadImage\UploadImageService;
use Illuminate\Support\Str;

class TransactionRepository
{
    private $transaction, $jwtService, $uploadImageService;

    public function __construct(Transaction $transaction, AuthService $jwtService, UploadImageService $uploadImageService)
    {
        $this->transaction = $transaction;
        $this->jwtService = $jwtService;
        $this->uploadImageService = $uploadImageService;
    }

    public function list(){
        $userId = $this->jwtService->userIdFromJwt();
        $customerData = Customer::where('user_id',$userId)->first();
        return $this->transaction::where('customer_id',$customerData->id)->get();
    }

    public function transaction($request){
        $userId = $this->jwtService->userIdFromJwt();
        $customerData = Customer::where('user_id',$userId)->first();
        $productData = Product::where('id',$request->product_id)->first();
        $data = new $this->transaction;
        $data->transaction_ref = Str::random(4).'-'.date_format(now(),'dmY');
        $data->merchant_id = $productData->merchant_id;
        $data->product_id = $productData->id;
        $data->customer_id = @$customerData->id;
        $data->note = $request->note ?? "";
        $data->qty = $request->qty;
        $data->bill_total = $request->qty * $request->amount;
        $data->status = 'waiting_payment';
        $data->save();
        return $data;
    }

    public function transactionConfirmPayment($request, $id){
        $nameStorage = 'Image/payment/';
        $data = new TransactionPayment();
        $data->transaction_id = $id;
        $data->amount = $request->amount;
        $data->bank_from = $request->bank_from;
        $data->bank_to = $request->bank_to ?? "";
        $data->note = $request->note;
        if (!empty($request->image) ) {
            $nameImage = $this->uploadImageService->imageProcessingStore($nameStorage, $request->image);
            $data->image = $nameImage;
        }
        $data->status = 'pending';
        $data->save();
        return $data;
    }

    public function transactionSuccess($request, $id){
        $transaction = $this->transaction::where('id',$id)->first();
        $transaction->status = 'done';
        $transaction->save();
        $data = TransactionPayment::where('transaction_id',$id)->first();
        $data->note = $request->note;
        $data->status = 'success';
        $data->success_at = now();
        $data->reject_at = null;
        $data->save();
        return $data;
    }

    public function transactionReject($request, $id){
        $transaction = $this->transaction::where('id',$id)->first();
        $transaction->status = 'cancel';
        $transaction->save();

        $data = TransactionPayment::where('transaction_id',$id)->first();
        $data->note = $request->note;
        $data->status = 'reject';
        $data->reject_at = now();
        $data->success_at = null;
        $data->save();
        return $data;
    }


}
