<?php

namespace App\Http\Controllers\Lauz;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use App\Services\BigQueryService;

class AccountsController extends Controller
{

    protected $bigQueryService;

    public function __construct(BigQueryService $bigQueryService)
    {
        $this->bigQueryService = $bigQueryService;
    }

    public function getAccounts(Request $request){   
        $query = "
            SELECT 
                User,Account
            FROM 
                `algolabreport.Metrics.Metrics_Accounts` 
            WHERE 
                User = '". auth()->user()->email ."'
            ORDER BY
                Account
            ;
        ";
        $results = $this->bigQueryService->runQuery($query);
        
        $resultsArray = [];
        foreach ($results as $row) {
            $resultsArray[] = $row;
            }
           
        return response()->json($resultsArray);     
    }



}
