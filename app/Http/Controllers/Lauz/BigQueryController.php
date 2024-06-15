<?php

namespace App\Http\Controllers\Lauz;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Exception;
use App\Services\BigQueryService;
use Illuminate\Support\Facades\Log;

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

        if($request->endDate){
            $whereDate = " AND T.Entry_Time BETWEEN '". $request->initDate ."' AND '". $request->endDate ."' ";
        }else{
            $whereDate = "";
        }

        if($request->Market_pos){
            $whereMarket_pos = " AND  T.Market_pos_ = '". $request->Market_pos. "'";
        }else{
            $whereMarket_pos = "";
        }

        if($request->Trade_Result){
            $whereTrade_Result = " AND  T.Trade_Result = '". $request->Trade_Result. "'";
        }else{
            $whereTrade_Result = "";
        }

        if($request->Instrument){
            $whereInstrument = " AND  Instrument = '". $request->Instrument. "'";
        }else{
            $whereInstrument = "";
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
                ".$whereDate." 
                ".$whereMarket_pos."
                ".$whereTrade_Result."
                ".$whereInstrument."
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
        $user = Auth::user()->email;
        if($request->account){
            $whereAccount = " WHERE Account = '". $request->account. "'";
        }else{
            $whereAccount = "";
        }
        if($request->endDate){
            $whereDate = " AND Entry_Time BETWEEN '". $request->initDate ."' AND '". $request->endDate ."' ";
        }else{
            $whereDate = "";
        }

        if($whereAccount){
            $whereUser = " AND Email = '". $user. "'";
        }else{
            $whereUser = "";
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

            FROM `algolabreport.NewData.Total_Trades`
             ".$whereAccount."
            ".$whereDate."
            ".$whereUser."
            ".$whereMarket_pos."
            ".$whereTrade_Result."
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

    public function getMFE(Request $request){
        $user = Auth::user()->email;
        if($request->account){
            $whereAccount = " WHERE T.Account = '". $request->account. "'";
        }else{
            $whereAccount = "";
        }
        if($request->endDate){
            $whereDate = " AND Entry_Time BETWEEN '". $request->initDate ."' AND '". $request->endDate ."' ";
        }else{
            $whereDate = "";
        }

        if($whereAccount){
            $whereUser = " AND T.Email = '". $user. "'";
        }else{
            $whereUser = "";
        }

        if($request->Market_pos){
            $whereMarket_pos = " AND  T.Market_pos_ = '". $request->Market_pos. "'";
        }else{
            $whereMarket_pos = "";
        }

        if($request->Trade_Result){
            $whereTrade_Result = " AND  T.Trade_Result = '". $request->Trade_Result. "'";
        }else{
            $whereTrade_Result = "";
        }

        $query = "
        SELECT
            T.User,
            T.Account,
            CAST(SUM(T.Net_PNL) AS FLOAT64) AS Net_PNL,
            CAST(SUM(T.Commission) AS FLOAT64) AS Commission,
            CAST(AVG(T.Avg_MFE) AS FLOAT64) AS MFE,
            CAST(AVG(T.Avg_MAE) AS FLOAT64) AS MAE,
            CAST(SUM(T.Profit) / COUNT(DISTINCT T.Entry_Time) AS FLOAT64) AS AVG_Trade,
            COUNT(DISTINCT T.Entry_Time) / NULLIF(DATE_DIFF(MAX(T.Entry_Time),
            MIN(T.Entry_Time), DAY), 0) * 252 / 365 AS AVG_Trades_Per_Day,
            0 as Shape_Ratio
            FROM
            (
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
            ".$whereDate."
            ".$whereUser."
            ".$whereMarket_pos."
            ".$whereTrade_Result."
            ) AS T
            GROUP BY T.User, T.Account, EXTRACT(YEAR FROM T.Entry_Time), EXTRACT(MONTH FROM
            T.Entry_Time);
        ";

        $results = $this->bigQueryService->runQuery($query);

        $resultsArray = [];
        foreach ($results as $row) {
            $resultsArray[] = $row;
        }

        return response()->json($resultsArray);
    }


    public function getMetrics(Request $request){
        $user = Auth::user()->email;
        if($request->account){
            $whereAccount = " WHERE Account = '". $request->account. "'";
        }else{
            $whereAccount = "";
        }
        if($request->endDate){
            $whereDate = " AND Entry_Time BETWEEN '". $request->initDate ."' AND '". $request->endDate ."' ";
        }else{
            $whereDate = "";
        }

        if($whereAccount){
            $whereUser = " AND Email = '". $user. "'";
        }else{
            $whereUser = "";
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

        $query = "
        WITH Daily_Profit AS (
            SELECT
                Account,
                DATE(Entry_time) AS Entry_date,
                CASE WHEN SUM(Profit) >= 0 THEN 'Positive' ELSE 'Negative' END as Status 
            FROM
                `algolabreport.NewData.Total_Trades`
            ".$whereAccount."
            ".$whereDate."
            ".$whereUser."
            ".$whereMarket_pos."
            ".$whereTrade_Result."
            GROUP BY
                Account, Entry_date 
        ),
        Metrics_Account AS ( 
            SELECT
                T.Email AS User,
                T.Account,
                T.Inicial_Balance,
                SUM(T.Profit) AS Net_PNL,
                COUNT(T.Entry_time) AS Q_Trades,
                POWER(
                1 + (SUM(T.Profit) / T.Inicial_Balance),
                365.0 / NULLIF(DATE_DIFF(MAX(T.Entry_time), MIN(T.Entry_time), DAY), 0)
                ) - 1 AS Annual_Return,
                SUM(CASE WHEN T.Profit > 0 THEN T.Profit ELSE 0 END) / NULLIF(SUM(CASE WHEN T.Profit <= 0 THEN T.Profit ELSE 0 END) * -1, 0) AS Profit_Factor,
                COUNT(CASE WHEN T.Profit > 0 THEN T.Entry_Time END) / COUNT(T.Entry_Time) AS Avg_Win_Ratio,
                AVG(CASE WHEN T.Profit > 0 THEN T.Profit ELSE NULL END) / ABS(AVG(CASE WHEN T.Profit <= 0 THEN T.Profit ELSE NULL END)) AS Avg_Win_Loss,
                POWER(
                (T.Inicial_Balance + SUM(T.Profit)) / T.Inicial_Balance,
                1.0 / (DATE_DIFF(MAX(T.Entry_time), MIN(T.Entry_time), DAY) / 365.25)
                ) - 1 AS CAGR,
                MIN(T.DrowDown) AS DrawDown,
                COUNT(CASE WHEN Trade_Result = 'Win' THEN 1 END) as Trade_Win,
                COUNT(CASE WHEN Trade_Result = 'Loss' THEN 1 END) as Trade_Loss -- Total de transacciones perdedoras.
            FROM
                    `algolabreport.NewData.Total_Trades` AS T
            GROUP BY
                T.Email, T.Account, T.Inicial_Balance
        ),

        Daily_Status_Count AS ( 
            SELECT
                Account, 
                COUNT(CASE WHEN Status = 'Positive' THEN 1 END) AS Positive_Days,
                COUNT(CASE WHEN Status = 'Negative' THEN 1 END) AS Negative_Days
            FROM
                Daily_Profit
            GROUP BY
                Account
        )

        SELECT
            R.User,
            R.Account,
            CAST(R.Inicial_Balance AS FLOAT64) AS Inicial_Balance,
            CAST(R.Net_PNL AS FLOAT64) AS Net_PNL,
            R.Q_Trades,
            R.Annual_Return,
            CAST(R.Profit_Factor AS FLOAT64) AS Profit_Factor,
            R.Avg_Win_Ratio,
            CAST(R.Avg_Win_Loss AS FLOAT64) AS Avg_Win_Loss,
            R.CAGR,
            CAST(R.DrawDown AS FLOAT64) AS DrawDown,
            R.Trade_Win,
            R.Trade_Loss,
            COALESCE(D.Positive_Days, 0) AS Positive_Days,
            COALESCE(D.Negative_Days, 0) AS Negative_Days,
            COALESCE(D.Positive_Days, 0) / NULLIF(COALESCE(D.Positive_Days, 0) + COALESCE(D.Negative_Days, 0), 0) AS Avg_Win_Ratio_Day
        FROM
            Metrics_Account AS R 
        LEFT JOIN
            Daily_Status_Count AS D ON
            R.Account = D.Account;
        ";

        $results = $this->bigQueryService->runQuery($query);

        $resultsArray = [];
        foreach ($results as $row) {
            $resultsArray[] = $row;
        }

        return response()->json($resultsArray);
    }
}
