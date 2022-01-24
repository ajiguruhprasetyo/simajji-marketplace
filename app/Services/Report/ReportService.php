<?php

namespace App\Services\Report;

use App\Repositories\Report\ReportRepository;

class ReportService
{
    private $repoReport;
    public function __construct(ReportRepository $repoReport)
    {
        $this->repoReport = $repoReport;
    }

    public function reportMerchant($userId)
    {
        try {
           $data = $this->repoReport->reportMerchant($userId);
           return $data;
        } catch (\Throwable $e){
            return $e->getMessage();
        }
    }

    public function reportOutlet($userId)
    {
        try {
            $data = $this->repoReport->reportOutlet($userId);
            return $data;
        } catch (\Throwable $e){
            return $e->getMessage();
        }
    }


}
