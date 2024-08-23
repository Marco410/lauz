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

    /**
        * Get the net profit for a given account and period.
        *
        * @param Request $request The HTTP request containing the account and period parameters.
        * @return JsonResponse A JSON response containing the net profit data.
        *
        * @throws Exception If there is an error running the BigQuery query.
        *
        * @docparam param1 name "account" type "string" description "The account for which to retrieve the net profit."
        * @docparam param2 name "initDate" type "string" description "The start date for the period in YYYY-MM-DD format."
        * @docparam param3 name "endDate" type "string" description "The end date for the period in YYYY-MM-DD format."
        * @docparam param4 name "Period" type "string" description "The period for which to retrieve the net profit. Can be one of 'Years', 'Months', 'Weeks', 'Days', or 'Hours'."
        * @docreturn type "array" description "An array of objects containing the net profit data for the specified account and period."
    */
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

    /**
     * Get the maximum drawdown for a given account and period.
     *
     * @param Request $request The HTTP request containing the account and period parameters.
     * @return JsonResponse A JSON response containing the maximum drawdown data.
     *
     * @throws Exception If there is an error running the BigQuery query.
     *
     * @docparam param1 name "account" type "string" description "The account for which to retrieve the maximum drawdown."
     * @docparam param2 name "initDate" type "string" description "The start date for the period in YYYY-MM-DD format."
     * @docparam param3 name "endDate" type "string" description "The end date for the period in YYYY-MM-DD format."
     * @docparam param4 name "Period" type "string" description "The period for which to retrieve the maximum drawdown. Can be one of 'Years', 'Months', 'Weeks', 'Days', or 'Hours'."
     * @docparam param5 name "Day_Name" type "string" description "The name of the day for which the maximum drawdown is calculated."
     * @docparam param6 name "Entry_date" type "string" description "The date for which the maximum drawdown is calculated."
     * @docparam param7 name "Total_PNL" type "float" description "The total profit and loss for the given period and account."
     * @docparam param8 name "Total_Trades" type "float" description "The total number of trades for the given period and account."
     * @docparam param9 name "Avg_Win_Ratio" type "float" description "The average win ratio for the given period and account."
     * @docparam param10 name "Profits" type "float" description "The total profits for the given period and account."
     * @docparam param11 name "Losses" type "float" description "The total losses for the given period and account."
     * @docparam param12 name "Q_Trades" type "int" description "The total number of trades for the given period and account."
     * @docparam param13 name "Winning_Days" type "int" description "The total number of days with positive profits for the given period and account."
     * @docparam param14 name "Losing_Days" type "int" description "The total number of days with negative profits for the given period and account."
     * @docreturn type "array" description "An array of objects containing the maximum drawdown data for the specified account and period."
     */
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

    /**
     * Get the list of instruments for the specified account.
     *
     * @param Request $request The HTTP request containing the account parameter.
     * @return JsonResponse A JSON response containing the list of instruments for the specified account.
     *
     * @throws Exception If there is an error running the BigQuery query.
     *
     * @docparam param1 name "account" type "string" description "The account for which to retrieve the list of instruments."
     * @docreturn type "array" description "An array of objects containing the list of instruments for the specified account."
    */
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

    /**
     * Get the overview of the specified account's trading activity for a given day.
     *
     * @param Request $request The HTTP request containing the account and day parameters.
     * @return JsonResponse A JSON response containing the overview of the specified account's trading activity for the given day.
     *
     * @throws Exception If there is an error running the BigQuery query.
     *
     * @docparam param1 name "account" type "string" description "The account for which to retrieve the trading activity overview."
     * @docparam param2 name "initDate" type "string" description "The start date for the period in YYYY-MM-DD format."
     * @docparam param3 name "endDate" type "string" description "The end date for the period in YYYY-MM-DD format."
     * @docparam param4 name "Day_Name" type "string" description "The name of the day for which the trading activity overview is calculated."
     * @docparam param5 name "Entry_date" type "string" description "The date for which the trading activity overview is calculated."
     * @docparam param6 name "Total_PNL" type "float" description "The total profit and loss for the given day and account."
     * @docparam param7 name "Total_Trades" type "float" description "The total number of trades for the given day and account."
     * @docparam param8 name "Avg_Win_Ratio" type "float" description "The average win ratio for the given day and account."
     * @docparam param9 name "Profits" type "float" description "The total profits for the given day and account."
     * @docparam param10 name "Losses" type "float" description "The total losses for the given day and account."
     * @docparam param11 name "Q_Trades" type "int" description "The total number of trades for the given day and account."
     * @docparam param12 name="Winning_Days" type "int" description "The total number of days with positive profits for the given day and account."
     * @docparam param13 name="Losing_Days" type "int" description "The total number of days with negative profits for the given day and account."
     * @docreturn type "array" description "An array of objects containing the overview of the specified account's trading activity for the given day."
     */
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
