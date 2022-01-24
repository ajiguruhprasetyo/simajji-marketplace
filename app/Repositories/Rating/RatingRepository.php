<?php

namespace App\Repositories\Rating;


use App\Models\ProductRating;
use App\Models\Transaction;

class RatingRepository
{
    private $rating;

    public function __construct(ProductRating $rating)
    {
        $this->rating = $rating;
    }

    public function rating($request){
        $validate = $this->rating::where('transaction_id', $request->transaction_id)->first();
        $transaction = Transaction::where('id', $validate->transaction_id)->first();
        $count = Transaction::where('product_id', $transaction->product_id)->where('customer_id', $transaction->customer_id)->count();

        if (empty($validate) && $count < 1 ){
            $data = new $this->rating;
            $data->transaction_id = $request->transaction_id;
            $data->value = $request->value;
            $data->comment = $request->comment;
            $data->status = 'active';
            $data->save();
            return true;
        } else {
            return false;
        }
    }

    public function ratingProduct($productId){
        return ProductRating::select('trx.transaction_ref',
            'p.name_product',
            'c.name as customer_name',
            'Product_ratings.value',
            'Product_ratings.comment',
            'Product_ratings.created_at')
            ->leftJoin('Transactions as trx','trx.id','Product_ratings.transaction_id')
            ->leftJoin('Products as p','p.id','trx.product_id')
            ->leftJoin('Customers as c','c.id','trx.customer_id')
            ->where('p.id',$productId)
            ->get();
    }


}
