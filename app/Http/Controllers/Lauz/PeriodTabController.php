<?php

namespace App\Http\Controllers\Lauz;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Exception;
use App\Services\BigQueryService;

class PeriodTabController extends Controller
{

    protected $bigQueryService;

    public function __construct(BigQueryService $bigQueryService)
    {
        $this->bigQueryService = $bigQueryService;
    }


    public function getNetProfit(Request $request){   
        $whereAccount= "";

        if($request->account){
            $whereAccount = "WHERE Account = '". $request->account. "'";
        }else{
            $whereAccount = "";
        }
        
        if($request->endDate){
            $whereDate = " AND Entry_Time BETWEEN '". $request->initDate ."' AND '". $request->endDate ."' ";
        }else{
            $whereDate = "";
        }
        $query = "
            SELECT 
                Account, 
                CONCAT(
                    LPAD(CAST(EXTRACT(DAY FROM Entry_Time) AS STRING),2,'0'),
                    '/',
                    LPAD(CAST(EXTRACT(MONTH FROM Entry_Time) AS STRING),2,'0'),
                    '/',
                    EXTRACT(YEAR FROM Entry_Time)
                    ) AS EntryTime,
                CAST(Profit AS FLOAT64) AS Profit,
            FROM 
                `algolabreport.NewData.Total_Trades`
            ".$whereAccount."
            ".$whereDate."
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

    public function getMaxDrawdown(Request $request){   
        $whereAccount= "";

        if($request->account){
            $whereAccount = "WHERE Account = '". $request->account. "'";
        }else{
            $whereAccount = "";
        }
        
        if($request->endDate){
            $whereDate = " AND Entry_Time BETWEEN '". $request->initDate ."' AND '". $request->endDate ."' ";
        }else{
            $whereDate = "";
        }
        $query = "
        SELECT 
            Account, 
            CONCAT(
                LPAD(CAST(EXTRACT(DAY FROM Entry_Time) AS STRING),2,'0'),
                '/',
                LPAD(CAST(EXTRACT(MONTH FROM Entry_Time) AS STRING),2,'0'),
                '/',
                EXTRACT(YEAR FROM Entry_Time)
                ) AS EntryTime,
                CAST(Min(DrowDown) AS FLOAT64)  as Drawdown 
        FROM 
            `algolabreport.NewData.Total_Trades`
        ".$whereAccount."
        ".$whereDate."
        GROUP BY 
            Account, 
            Entry_Time;
        ";

        $results = $this->bigQueryService->runQuery($query);

        $resultsArray = [];
        foreach ($results as $row) {
            $resultsArray[] = $row;
        }
        
        return response()->json($resultsArray);     
    }

}
