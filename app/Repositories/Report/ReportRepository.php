<?php

namespace App\Repositories\Report;

use Illuminate\Support\Facades\DB;

class ReportRepository
{

    public function __construct()
    {
        $this->page = 5;
    }

    public function reportMerchant($userId){
        $subQuery = DB::table('Merchants as mc')->select('mc.merchant_name',
            'trx.bill_total',
            'trx.merchant_id',
            'mc.user_id',
            DB::raw('CAST( trx.created_at AS DATE ) AS date'))
            ->leftJoin('Transactions as trx','trx.merchant_id','mc.id');
        $q = DB::table(DB::raw('('.$subQuery->toSql().') as report'))
            ->selectRaw('merchant_name, sum(bill_total) AS omzet, date')
            ->where('user_id',$userId)
            ->groupBy(	'merchant_name', 'date')
            ->mergeBindings($subQuery)
            ->paginate($this->page);
        return $q;
    }

    public function reportOutlet($userId){
        $subQuery = DB::table('Merchants as mc')
            ->select('mc.merchant_name',
            'trx.bill_total',
            'trx.merchant_id',
            'mc.user_id',
            'otl.outlet_name',
            DB::raw('CAST( trx.created_at AS DATE ) AS date'))
            ->leftJoin('Transactions as trx','trx.merchant_id','mc.id')
            ->leftJoin('Outlets as otl','mc.id','otl.merchant_id');
        $q = DB::table(DB::raw('('.$subQuery->toSql().') as report'))
            ->selectRaw('merchant_name, outlet_name, sum(bill_total) AS omzet, date')
            ->where('user_id',$userId)
            ->groupBy(	'merchant_name', 'outlet_name', 'date')
            ->mergeBindings($subQuery)
            ->paginate($this->page);
        return $q;
    }
}
