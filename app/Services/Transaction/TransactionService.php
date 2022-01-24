<?php

namespace App\Services\Transaction;

use App\Repositories\Transaction\TransactionRepository;

class TransactionService
{
    private $repoTransaction;

    public function __construct(TransactionRepository $repoTransaction)
    {
        $this->repoTransaction = $repoTransaction;
    }

    public function list()
    {
        try {
            $data = $this->repoTransaction->list();
            return response()->json(['message' => true, 'data' => $data], 200);
        } catch (\Throwable $e){
            return response()->json(['message' => false, 'data' => $e->getMessage()], 401);
        }
    }

    public function transaction($request)
    {
        try {
           $data = $this->repoTransaction->transaction($request);

           return response()->json(['message' => true, 'data' => 'transaction status waiting for payment'], 200);
        } catch (\Throwable $e){
            return response()->json(['message' => false, 'data' => $e->getMessage()], 401);
        }
    }

    public function transactionConfirmPayment($request,$id)
    {
        try {
            $data = $this->repoTransaction->transactionConfirmPayment($request, $id);
            return response()->json(['message' => true, 'data' => 'transaction status upload confirm payment'], 200);
        } catch (\Throwable $e){
            return response()->json(['message' => false, 'data' => $e->getMessage()], 401);
        }
    }

    public function transactionSuccess($request,$id)
    {
        try {
            $data = $this->repoTransaction->transactionSuccess($request, $id);
            return $data;
            return response()->json(['message' => true, 'data' => 'transaction status success payment'], 200);
        } catch (\Throwable $e){
            return response()->json(['message' => false, 'data' => $e->getMessage()], 401);
        }
    }

    public function transactionReject($request,$id)
    {
        try {
            $data = $this->repoTransaction->transactionReject($request, $id);
            return $data;
            return response()->json(['message' => true, 'data' => 'transaction status failed payment'], 200);
        } catch (\Throwable $e){
            return response()->json(['message' => false, 'data' => $e->getMessage()], 401);
        }
    }


}
