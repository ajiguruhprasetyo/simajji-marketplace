<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Report\ReportService;

class ReportController extends Controller
{
    private $serviceReport;

    public function __construct(ReportService $serviceReport){
        $this->serviceReport = $serviceReport;
    }

    public function merchant(){

        $userId = $this->userIdFromJwt();
        $data = $this->serviceReport->reportMerchant($userId);
        return response()->json(['message' => true, 'data'=> $data]);
    }

    public function outlet(){

        $userId = $this->userIdFromJwt();
        $data = $this->serviceReport->reportOutlet($userId);
        return response()->json(['message' => true, 'data'=> $data]);
    }

    public function userIdFromJwt(){
        $token = request()->bearerToken();
        $tokenParts = explode(".", @$token);
        $tokenPayload = base64_decode(@$tokenParts[1]);
        $jwtPayload = json_decode(@$tokenPayload);
        return $jwtPayload->sub ?? 0;
    }
}
