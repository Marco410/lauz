<?php

namespace App\Http\Controllers\Lauz;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Exception;
use App\Services\BigQueryService;

class BigQueryController extends Controller
{

    protected $bigQueryService;

    public function __construct(BigQueryService $bigQueryService)
    {
        $this->bigQueryService = $bigQueryService;
    }

    public function getNetPL(Request $request){

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
                Instrument,
                EXTRACT(YEAR FROM Entry_Time) AS Year,
                EXTRACT(MONTH FROM Entry_Time) AS Month,
                EXTRACT(WEEK FROM Entry_Time) AS Week,
                EXTRACT(DAYOFYEAR FROM Entry_Time) AS Day,
                EXTRACT(HOUR FROM Entry_Time) AS Hour,
                CONCAT(EXTRACT(HOUR FROM Entry_Time), ':', 
                    CASE 
                        WHEN EXTRACT(MINUTE FROM Entry_Time) <= 29 THEN '00'
                        ELSE '30'
                    END) AS Half_Hour,
                    SUM(CAST(Profit AS FLOAT64)) AS NetPL
            FROM
                `algolabreport.NewData.Total_Trades`
            ".$whereAccount."
            ".$whereDate." 
            GROUP BY
                Instrument,
                Year,
                Month,
                Week,
                Day,
                Hour,
                Half_Hour
            ORDER BY
                Instrument,
                Year,
                Month,
                Week,
                Day,
                Hour,
                Half_Hour;
        
        ";

        $results = $this->bigQueryService->runQuery($query);

        $resultsArray = [];
        $groupedData = [];
        $totalNetPL = 0; 
        
        foreach ($results as $row) {
            $year = $row['Year'];
            $month = $row['Month'];
        
            if (!isset($groupedData[$year])) {
                $groupedData[$year] = [];
            }
        
            if (!isset($groupedData[$year][$month])) {
                $groupedData[$year][$month] = [
                    'totalNetPL' => 0, 
                    'data' => [] 
                ];
            }
        
            $groupedData[$year][$month]['totalNetPL'] += $row['NetPL'];
            $totalNetPL += $row['NetPL'];
            $groupedData[$year][$month]['data'][] = $row;
        }
        
        $groupedData['totalNetPL'] = $totalNetPL;
        return response()->json($groupedData);
    }

  

    public function getOverviewData(Request $request){   
        $whereAccount= "";
        if($request->account){
            $whereAccount = " AND Account = '". $request->account. "'";
        }else{
            $whereAccount = "";
        }


        $query = "
            SELECT 
                User,Account, CAST(Inicial_Balance AS FLOAT64) AS Inicial_Balance, CAST(Net_PNL AS FLOAT64) AS Net_PNL , Q_Trades, Annual_Return, CAST(Profit_Factor AS FLOAT64) AS Profit_Factor, Avg_Win_Ratio, CAST(Avg_Win_Loss AS FLOAT64) AS Avg_Win_Loss, CAGR, CAST(DrawDown AS FLOAT64) AS DrawDown    
            FROM 
                `algolabreport.Metrics.Metrics_Accounts`
            WHERE 
                User = '". auth()->user()->email ."'
            ".$whereAccount."
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

    public function getCalendar(Request $request){ 
        $whereAccount= "";
        if($request->account){
            $whereAccount = "WHERE Account = '". $request->account. "'";
        }else{
            $whereAccount = "";
        }
        
        $query = "
            SELECT
                T.User,
                T.Account,
                SUM(CAST(T.Net_PNL AS FLOAT64)) AS NetPL,
                COUNT(DISTINCT T.Entry_Time) / NULLIF(DATE_DIFF(MAX(T.Entry_Time), MIN(T.Entry_Time), DAY), 0) * 252 / 365 AS AVG_Trades_Per_Day,
                0 as Shape_Ratio,
                CONCAT(
                    EXTRACT(YEAR FROM T.Entry_Time),
                    '-',
                    LPAD(CAST(EXTRACT(MONTH FROM T.Entry_Time) AS STRING),2,'0'),
                    '-',
                    LPAD(CAST(EXTRACT(DAY FROM T.Entry_Time) AS STRING),2,'0')
                    ) AS EntryTime, 
                FROM (
                 SELECT
                T.Email AS User,
                T.Account, 
                T.Entry_Time,
                T.Profit AS Net_PNL, 
                T.Profit, 
                T.Commission,
                T.MFE AS Avg_MFE,
                T.MAE AS Avg_MAE,
                T.Trade_Result 
                FROM `algolabreport.NewData.Total_Trades` AS T
                ".$whereAccount."
                 ) AS T
                GROUP BY 
                    T.User, 
                    T.Account, 
                    T.Entry_Time,
                    EXTRACT(YEAR FROM T.Entry_Time), 
                    EXTRACT(MONTH FROM T.Entry_Time)
                ORDER BY
                    T.Entry_Time DESC;
        ";

        $results = $this->bigQueryService->runQuery($query);

        $resultsArray = [];
        foreach ($results as $row) {
            $resultsArray[] = $row;
        }
        
        return response()->json($resultsArray);     
    }

    public function getTotalTrades(Request $request){   
        $query = "
            SELECT 
                Account,
                Instrument,
                Market_pos_,
                Strategy,
                QTY,
                CAST(Cum_net_profit AS FLOAT64) AS CumNetProfit, 
                CONCAT(
                    LPAD(CAST(EXTRACT(DAY FROM Entry_Time) AS STRING),2,'0'),
                    '/',
                    LPAD(CAST(EXTRACT(MONTH FROM Entry_Time) AS STRING),2,'0'),
                    '/',
                    EXTRACT(YEAR FROM Entry_Time)
                    ) AS EntryTime,
                Entry_name,
                CAST(Entry_price AS FLOAT64) AS EntryPrice, 
                Exit_name,
                CAST(Exit_price AS FLOAT64) AS ExitPrice, 
                CAST(ETD AS FLOAT64) AS ETD, 
                CONCAT(
                    LPAD(CAST(EXTRACT(DAY FROM Exit_time) AS STRING),2,'0'),
                    '/',
                    LPAD(CAST(EXTRACT(MONTH FROM Exit_time) AS STRING),2,'0'),
                    '/',
                    EXTRACT(YEAR FROM Exit_time)
                ) AS ExitTime,
                CAST(MAE AS FLOAT64) AS MAE, 
                CAST(MFE AS FLOAT64) AS MFE, 
                CAST(Profit AS FLOAT64) AS Profit, 
                CAST(Acum_Profit AS FLOAT64) AS AcumProfit, 
                CAST(DrowDown AS FLOAT64) AS DrowDown, 
            
            FROM `algolabreport.NewData.Total_Trades`;
        ";

        $results = $this->bigQueryService->runQuery($query);

        $resultsArray = [];
        foreach ($results as $row) {
            $resultsArray[] = $row;
        }
        
        return response()->json($resultsArray);     
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

}
