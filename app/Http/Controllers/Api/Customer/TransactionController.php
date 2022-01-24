<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Services\Transaction\TransactionService;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    private $transactionService;

    public function __construct(TransactionService $transactionService){
        $this->transactionService = $transactionService;
    }

    public function listTransaction(){
        return $this->transactionService->list();
    }

    public function transactionWaitingPayment(Request $request){
        return $this->transactionService->transaction($request);
    }

    public function transactionConfirmPayment(Request $request, $id){
        return $this->transactionService->transactionConfirmPayment($request,$id);
    }

    public function transactionSuccess(Request $request, $id){
        return $this->transactionService->transactionSuccess($request,$id);
    }

    public function transactionReject(Request $request, $id){
        return $this->transactionService->transactionReject($request,$id);
    }


}
