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
        $profitSelect = " 
        CONCAT(
            LPAD(CAST(EXTRACT(DAY FROM Entry_Time) AS STRING),2,'0'),
            '/',
            LPAD(CAST(EXTRACT(MONTH FROM Entry_Time) AS STRING),2,'0'),
            '/',
            EXTRACT(YEAR FROM Entry_Time)
            ) AS EntryTime,
            CAST(Profit AS FLOAT64) AS Profit,
        ";
        $groupBy = "";
        $orderBy = "
        ORDER BY
            Account,
            Entry_Time
        ";

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
        if($request->Market_pos){
            $whereMarket_pos = " AND  Market_pos_ = '". $request->Market_pos. "'";
        }else{
            $whereMarket_pos = "";
        }

        if($request->Trade_Result){
            $whereTrade_Result = " AND  Trade_Result = '". $request->Trade_Result. "'";
        }else{
            $whereTrade_Result = "";
        }
        if($request->Instrument){
            $whereInstrument = " AND  Instrument = '". $request->Instrument. "'";
        }else{
            $whereInstrument = "";
        }

        if($request->Period){
            switch($request->Period){
                case 'Years':
                    $profitSelect = "
                        EXTRACT(YEAR FROM Entry_Time) AS EntryTime,
                        SUM(CAST(Profit AS FLOAT64)) AS Profit,";
                    $groupBy = "
                        GROUP BY 
                            Account, 
                            EXTRACT(YEAR FROM Entry_Time)";
                    $orderBy = "
                    ORDER BY
                        Account
                    ";
                break;
                case 'Months':
                    $profitSelect = "
                        EXTRACT(YEAR FROM Entry_Time) as year,
                        CONCAT(
                            LPAD(CAST(EXTRACT(MONTH FROM Entry_Time) AS STRING),2,'0'),
                            '/',
                            EXTRACT(YEAR FROM Entry_Time)
                        ) AS EntryTime,
                        SUM(CAST(Profit AS FLOAT64)) AS Profit,";
                    $groupBy = "
                        GROUP BY 
                            Account, 
                            EntryTime,
                            year
                            ";
                    $orderBy = "
                        ORDER BY
                            Account,
                            year,
                            EntryTime
                        ";
                break;
                case 'Weeks':
                    $profitSelect = "
                        EXTRACT(MONTH FROM Entry_Time) as month,
                        EXTRACT(YEAR FROM Entry_Time) as year,
                        CONCAT(
                            'Week ',
                            LPAD(CAST(EXTRACT(WEEK FROM Entry_Time) AS STRING),2,'0'),
                            ', ',
                            EXTRACT(YEAR FROM Entry_Time)
                        ) AS EntryTime,
                        SUM(CAST(Profit AS FLOAT64)) AS Profit,";
                    $groupBy = "
                        GROUP BY 
                            Account, 
                            EntryTime,
                            year,
                            month
                            ";
                            $orderBy = "
                        ORDER BY
                            Account,
                            year,
                            month,
                            EntryTime
                        ";
                break;
                case 'Days':
                    $profitSelect = "
                        EXTRACT(Day FROM Entry_Time) as day,
                        EXTRACT(MONTH FROM Entry_Time) as month,
                        EXTRACT(YEAR FROM Entry_Time) as year,
                        CONCAT(
                            LPAD(CAST(EXTRACT(DAY FROM Entry_Time) AS STRING),2,'0'),
                            '/',
                            LPAD(CAST(EXTRACT(MONTH FROM Entry_Time) AS STRING),2,'0'),
                            '/',
                            EXTRACT(YEAR FROM Entry_Time)
                            ) AS EntryTime,
                        SUM(CAST(Profit AS FLOAT64)) AS Profit,";
                    $groupBy = "
                        GROUP BY 
                            Account, 
                            EntryTime,
                            year,
                            month,
                            day
                            ";
                            $orderBy = "
                        ORDER BY
                            Account,
                            year,
                            month,
                            day,
                            EntryTime
                        ";
                break;
                case 'Hours':
                    $profitSelect = "
                        EXTRACT(Hour FROM Entry_Time) as hour,
                        EXTRACT(Day FROM Entry_Time) as day,
                        EXTRACT(MONTH FROM Entry_Time) as month,
                        EXTRACT(YEAR FROM Entry_Time) as year,
                        CONCAT(
                            LPAD(CAST(EXTRACT(HOUR FROM Entry_Time) AS STRING),2,'0'),
                            ':00, ',
                            LPAD(CAST(EXTRACT(DAY FROM Entry_Time) AS STRING),2,'0'),
                            '/',
                            LPAD(CAST(EXTRACT(MONTH FROM Entry_Time) AS STRING),2,'0'),
                            '/',
                            EXTRACT(YEAR FROM Entry_Time)
                        ) AS EntryTime,
                        SUM(CAST(Profit AS FLOAT64)) AS Profit,";
                    $groupBy = "
                        GROUP BY 
                            Account, 
                            EntryTime,
                            year,
                            month,
                            day,
                            hour
                            ";
                            $orderBy = "
                        ORDER BY
                            Account,
                            year,
                            month,
                            day,
                            hour,
                            EntryTime
                        ";
                break;
                default:
                    $profitSelect = " 
                    CONCAT(
                        LPAD(CAST(EXTRACT(DAY FROM Entry_Time) AS STRING),2,'0'),
                        '/',
                        LPAD(CAST(EXTRACT(MONTH FROM Entry_Time) AS STRING),2,'0'),
                        '/',
                        EXTRACT(YEAR FROM Entry_Time)
                        ) AS EntryTime,
                        CAST(Profit AS FLOAT64) AS Profit,
                    ";
                    $groupBy = "";
                    break;

            }
        }

        $query = "
            SELECT 
                Account,
                ".$profitSelect." 
            FROM 
                `algolabreport.NewData.Total_Trades`
            ".$whereAccount."
            ".$whereDate."
            ".$whereMarket_pos."
            ".$whereTrade_Result."
            ".$whereInstrument."
            ".$groupBy."
            ".$orderBy."
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
        $drowdownSelect = " 
        CONCAT(
            LPAD(CAST(EXTRACT(DAY FROM Entry_Time) AS STRING),2,'0'),
            '/',
            LPAD(CAST(EXTRACT(MONTH FROM Entry_Time) AS STRING),2,'0'),
            '/',
            EXTRACT(YEAR FROM Entry_Time)
            ) AS EntryTime,
            CAST(Min(DrowDown) AS FLOAT64)  as Drawdown 
        ";
        $groupBy = "
            GROUP BY 
                Account, 
                Entry_Time
        ";
        $orderBy= "";
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
        if($request->Market_pos){
            $whereMarket_pos = " AND  Market_pos_ = '". $request->Market_pos. "'";
        }else{
            $whereMarket_pos = "";
        }

        if($request->Trade_Result){
            $whereTrade_Result = " AND  Trade_Result = '". $request->Trade_Result. "'";
        }else{
            $whereTrade_Result = "";
        }
        if($request->Instrument){
            $whereInstrument = " AND  Instrument = '". $request->Instrument. "'";
        }else{
            $whereInstrument = "";
        }

        if($request->Period){
            switch($request->Period){
                case 'Years':
                    $drowdownSelect = "
                        EXTRACT(YEAR FROM Entry_Time) AS EntryTime,
                        SUM(CAST(DrowDown AS FLOAT64)) AS Drawdown,";
                    $groupBy = "
                        GROUP BY 
                            Account, 
                            EXTRACT(YEAR FROM Entry_Time)";
                break;
                case 'Months':
                    $drowdownSelect = "
                        EXTRACT(YEAR FROM Entry_Time) as year,
                        CONCAT(
                            LPAD(CAST(EXTRACT(MONTH FROM Entry_Time) AS STRING),2,'0'),
                            '/',
                            EXTRACT(YEAR FROM Entry_Time)
                        ) AS EntryTime,
                        SUM(CAST(DrowDown AS FLOAT64)) AS Drawdown,";
                    $groupBy = "
                        GROUP BY 
                            Account, 
                            EntryTime,
                            year
                            ";
                    $orderBy = "
                        ORDER BY
                            Account,
                            year,
                            EntryTime
                        ";
                break;
                case 'Weeks':
                    $drowdownSelect = "
                        EXTRACT(MONTH FROM Entry_Time) as month,
                        EXTRACT(YEAR FROM Entry_Time) as year,
                        CONCAT(
                            'Week ',
                            LPAD(CAST(EXTRACT(WEEK FROM Entry_Time) AS STRING),2,'0'),
                            ', ',
                            EXTRACT(YEAR FROM Entry_Time)
                        ) AS EntryTime,
                        SUM(CAST(DrowDown AS FLOAT64)) AS Drawdown,";
                    $groupBy = "
                        GROUP BY 
                            Account, 
                            EntryTime,
                            year,
                            month
                            ";
                    $orderBy = "
                        ORDER BY
                            Account,
                            year,
                            month,
                            EntryTime
                        ";
                break;
                case 'Days':
                    $drowdownSelect = "
                        EXTRACT(Day FROM Entry_Time) as day,
                        EXTRACT(MONTH FROM Entry_Time) as month,
                        EXTRACT(YEAR FROM Entry_Time) as year,
                        CONCAT(
                            LPAD(CAST(EXTRACT(DAY FROM Entry_Time) AS STRING),2,'0'),
                            '/',
                            LPAD(CAST(EXTRACT(MONTH FROM Entry_Time) AS STRING),2,'0'),
                            '/',
                            EXTRACT(YEAR FROM Entry_Time)
                            ) AS EntryTime,
                        SUM(CAST(DrowDown AS FLOAT64)) AS Drawdown,";
                    $groupBy = "
                        GROUP BY 
                            Account, 
                            EntryTime,
                            year,
                            month,
                            day
                            ";
                    $orderBy = "
                        ORDER BY
                            Account,
                            year,
                            month,
                            day,
                            EntryTime
                        ";
                break;
                case 'Hours':
                    $drowdownSelect = "
                        EXTRACT(Hour FROM Entry_Time) as hour,
                        EXTRACT(Day FROM Entry_Time) as day,
                        EXTRACT(MONTH FROM Entry_Time) as month,
                        EXTRACT(YEAR FROM Entry_Time) as year,
                        CONCAT(
                            LPAD(CAST(EXTRACT(HOUR FROM Entry_Time) AS STRING),2,'0'),
                            ':00, ',
                            LPAD(CAST(EXTRACT(DAY FROM Entry_Time) AS STRING),2,'0'),
                            '/',
                            LPAD(CAST(EXTRACT(MONTH FROM Entry_Time) AS STRING),2,'0'),
                            '/',
                            EXTRACT(YEAR FROM Entry_Time)
                        ) AS EntryTime,
                        SUM(CAST(DrowDown AS FLOAT64)) AS Drawdown,";
                    $groupBy = "
                        GROUP BY 
                            Account, 
                            EntryTime,
                            year,
                            month,
                            day,
                            hour
                            ";
                    $orderBy = "
                        ORDER BY
                            Account,
                            year,
                            month,
                            day,
                            hour,
                            EntryTime
                        ";
                break;
                default:
                    $drowdownSelect = " 
                    CONCAT(
                        LPAD(CAST(EXTRACT(DAY FROM Entry_Time) AS STRING),2,'0'),
                        '/',
                        LPAD(CAST(EXTRACT(MONTH FROM Entry_Time) AS STRING),2,'0'),
                        '/',
                        EXTRACT(YEAR FROM Entry_Time)
                        ) AS EntryTime,
                        CAST(Min(DrowDown) AS FLOAT64)  as Drawdown 
                    ";
                    $groupBy = "
                        GROUP BY 
                            Account, 
                            Entry_Time
                    ";
                    break;
            }
      
        }
        
        $query = "
        SELECT 
            Account, 
            ".$drowdownSelect."
        FROM 
            `algolabreport.NewData.Total_Trades`
        ".$whereAccount."
        ".$whereDate."
        ".$whereMarket_pos."
        ".$whereTrade_Result."
        ".$whereInstrument."
        ".$groupBy."
        ".$orderBy."
        ;
        ";

        $results = $this->bigQueryService->runQuery($query);

        $resultsArray = [];
        foreach ($results as $row) {
            $resultsArray[] = $row;
        }
        
        return response()->json($resultsArray);     
    }


    public function getInstruments(Request $request){
        $whereAccount= "";

        if($request->account){
            $whereAccount = "WHERE Account = '". $request->account. "'";
        }else{
            $whereAccount = "";
        }
   
        $query = "
            SELECT
                Account,
                Instrument,
            FROM
                `algolabreport.NewData.Total_Trades`
            ".$whereAccount."
            GROUP BY
                Account,
                Instrument;
        ";

        $results = $this->bigQueryService->runQuery($query);

        $resultsArray = [];
        foreach ($results as $row) {
            $resultsArray[] = $row;
        }
        
        return response()->json($resultsArray);    
    }

    public function getOverviewDay(Request $request){
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
        if($request->Market_pos){
            $whereMarket_pos = " AND  Market_pos_ = '". $request->Market_pos. "'";
        }else{
            $whereMarket_pos = "";
        }

        if($request->Trade_Result){
            $whereTrade_Result = " AND  Trade_Result = '". $request->Trade_Result. "'";
        }else{
            $whereTrade_Result = "";
        }
        if($request->Instrument){
            $whereInstrument = " AND  Instrument = '". $request->Instrument. "'";
        }else{
            $whereInstrument = "";
        }
   
        $query = "
            WITH Filtered_Trades AS (
                SELECT 
                    Email AS User,
                    Entry_time,
                    Trade_Result,
                    Profit
                FROM 
                    `algolabreport.NewData.Total_Trades`
                ".$whereAccount."
                ".$whereDate."
                ".$whereMarket_pos."
                ".$whereTrade_Result."
                ".$whereInstrument."
            ),
            Daily_Results AS (
                SELECT
                    User,
                    FORMAT_TIMESTAMP('%A', Entry_time) AS Day_Name,
                    DATE(Entry_time) AS Entry_date,
                    SUM(Profit) AS Daily_Profit
                FROM
                    Filtered_Trades
                GROUP BY
                    User, Day_Name, Entry_date
            ),
            Daily_PNL AS (
                SELECT
                    User,
                    Day_Name,
                    SUM(CAST(Daily_Profit AS FLOAT64)) AS Total_PNL,
                    COUNT(CASE WHEN Daily_Profit > 0 THEN 1 ELSE NULL END) / COUNT(Entry_date) AS Avg_Win_Ratio,
                    SUM(CASE WHEN Daily_Profit > 0 THEN CAST(Daily_Profit AS FLOAT64) ELSE 0 END) as Profits,
                    SUM(CASE WHEN Daily_Profit <= 0 THEN CAST(Daily_Profit AS FLOAT64) ELSE 0 END) as Loss,
                    COUNT(Entry_date) AS Q_Trades,
                    COUNT(CASE WHEN Daily_Profit > 0 THEN 1 ELSE NULL END) AS Winning_Days,
                    COUNT(CASE WHEN Daily_Profit <= 0 THEN 1 ELSE NULL END) AS Losing_Days
                FROM
                    Daily_Results
                GROUP BY
                    User, Day_Name
            )
            SELECT
                User,
                Day_Name,
                Total_PNL,
                Avg_Win_Ratio,
                Profits,
                Loss,
                Q_Trades,
                Winning_Days,
                Losing_Days
            FROM
                Daily_PNL
            ORDER BY
                CASE Day_Name
                    WHEN 'Monday' THEN 1
                    WHEN 'Tuesday' THEN 2
                    WHEN 'Wednesday' THEN 3
                    WHEN 'Thursday' THEN 4
                    WHEN 'Friday' THEN 5
                    WHEN 'Saturday' THEN 6
                    WHEN 'Sunday' THEN 7
                END;
        ";

        $results = $this->bigQueryService->runQuery($query);

        $resultsArray = [];
        foreach ($results as $row) {
            $resultsArray[] = $row;
        }
        
        return response()->json($resultsArray);    
    }

}
