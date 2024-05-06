<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Exception;
use App\Services\BigQueryService;

class BigQueryController extends Controller
{

    /* $resultsArray = [];
    foreach ($results as $row) {
        $resultsArray[] = $row;
    } */

    protected $bigQueryService;

    public function __construct(BigQueryService $bigQueryService)
    {
        $this->bigQueryService = $bigQueryService;
    }

    public function getNetPL(Request $request)
    {

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

    public function getAnnualReturn(Request $request)
    {   
        $initial = "1";

        $query = "
            SELECT
                POWER((1 + (Sum(Profit)/".$initial.")),(365/DATETIME_DIFF(MAX(Date
                Entry_time), MIN(Date Entry_time), DAY))) - 1;
            FROM
                `algolabreport.NewData.Total_Trades`;
        ";

        $results = $this->bigQueryService->runQuery($query);

        $resultsArray = [];
        foreach ($results as $row) {
            $resultsArray[] = $row;
        }
        
        return response()->json($resultsArray);     
        
        $groupedData['totalNetPL'] = $totalNetPL;
        return response()->json($groupedData);
    }

    public function getProfitFactor(Request $request)
    {   
        $query = "
            SELECT
                SUM(CASE WHEN Profit > 0 THEN Profit ELSE 0 END)/(SUM(CASE WHEN Profit <= 0 THEN Profit ELSE 0 END)* -1)
            FROM
                `algolabreport.NewData.Total_Trades`;
        ";

        $results = $this->bigQueryService->runQuery($query);

        foreach ($results as $row) {
            return $row;
        }

        return response()->json($results->current());
    }

    public function getWinLost(Request $request)
    {   
        $query = "
            SELECT
                MIN(DrowDown)
            FROM
                `algolabreport.NewData.Total_Trades`;
        ";

        $results = $this->bigQueryService->runQuery($query);

        
   /*      $resultsArray = [];
        foreach ($results as $row) {
            $resultsArray[] = $row;
        }
        
        return response()->json($resultsArray); */

        return response()->json($results->current());
    }

}
