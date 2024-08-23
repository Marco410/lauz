<?php

namespace App\Http\Controllers\Lauz;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Exception;
use App\Services\BigQueryService;

class OverviewTabController extends Controller
{

    protected $bigQueryService;

    public function __construct(BigQueryService $bigQueryService)
    {
        $this->bigQueryService = $bigQueryService;
    }


    public function getDailyNetCumulativePL(Request $request)
    {   
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

        $query = "
        WITH Trade_Stats AS (
            SELECT
            Email AS User,
            Account,
            Instrument,
            Market_pos_ AS Direction,
            Trade_Result AS Winning_Losses,
            DATE(Entry_time) AS Entry_date,
            EXTRACT(YEAR FROM Entry_time) AS Year,
            EXTRACT(MONTH FROM Entry_time) AS Month,
            EXTRACT(WEEK FROM Entry_time) AS Week,
            EXTRACT(DAY FROM Entry_time) AS Day,
            SUM(CAST(Profit AS FLOAT64)) AS NetPNL 
            FROM
                `algolabreport.NewData.Total_Trades`
            ".$whereAccount."
            ".$whereDate." 
            ".$whereMarket_pos."
            ".$whereTrade_Result."
            GROUP BY
                Email, 
                Account, 
                Instrument, 
                Market_pos_, 
                Trade_Result, 
                Entry_date, 
                Year,
                Month, 
                Week, 
                Day),
        Cumulative_PNL_Calculation AS ( 
            SELECT
                User,
                Account,
                Instrument,
                Direction,
                Winning_Losses,
                Entry_date, 
                Year,
                Month,
                Week,
                Day,
                NetPNL,
                SUM(NetPNL) OVER (PARTITION BY Account ORDER BY Entry_date) AS Cummulative_PNL
            FROM
                `Trade_Stats`
            ),
        Drawdown_Calculation AS ( 
            SELECT
                User,
                Account,
                Instrument,
                Direction,
                Winning_Losses,
                Entry_date,
                Year,
                Month,
                Week,
                Day,
                NetPNL,
                Cummulative_PNL,
            CASE
                WHEN ROW_NUMBER() OVER (PARTITION BY Account ORDER BY Entry_date) = 1 THEN Cummulative_PNL
            ELSE Cummulative_PNL - MAX(Cummulative_PNL) OVER (PARTITION BY Account ORDER BY Entry_date ROWS BETWEEN UNBOUNDED PRECEDING AND CURRENT ROW)
                END AS Drawdown
            FROM
                `Cumulative_PNL_Calculation`
            )

            SELECT
                User,
                Account,
                Instrument,
                Direction,
                Winning_Losses,
                Year,
                Month,
                Week,
                Day,
                NetPNL,
                Cummulative_PNL, 
                Drawdown
            FROM
                `Drawdown_Calculation`
            ORDER BY
                User, Account, Year, Month, Week, Day;
        ";

        $results = $this->bigQueryService->runQuery($query);

        $resultsArray = [];
        foreach ($results as $row) {
            $resultsArray[] = $row;
        }
        
        return response()->json($resultsArray);     
    }

    public function getPerformanceTable(Request $request){   
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
        $query = "
            WITH Filtered_Trades AS (
                SELECT Email,
                    Entry_Time,
                    Exit_time,
                    Market_pos_,
                    DrowDown,
                    Profit
                FROM `algolabreport.NewData.Total_Trades`
               ".$whereAccount."
                ".$whereDate."
                ".$whereMarket_pos."
                ".$whereTrade_Result."
            ),
            Profit_Summary AS (
                SELECT
                    1 AS RowN, 
                    Email as User,
                    'Total Net Profit' AS Performance,
                    SUM(Profit) AS All_Trades,
                    SUM(CASE WHEN Market_pos_ = 'Long' THEN Profit ELSE 0 END) AS Longs,
                    SUM(CASE WHEN Market_pos_ = 'Short' THEN Profit ELSE 0 END) AS Shorts
                FROM Filtered_Trades
                GROUP BY Email
            ),
            Drawdown_Calculation AS (
                SELECT
                    2 AS RowN, 
                    Email as User,
                    'Max Drawdown' AS Performance,
                    MIN(DrowDown) AS All_Trades,
                    MIN(CASE WHEN Market_pos_ = 'Long' THEN DrowDown ELSE 0 END) AS Longs,
                    MIN(CASE WHEN Market_pos_ = 'Short' THEN DrowDown ELSE 0 END) AS Shorts
                FROM Filtered_Trades
                GROUP BY Email
            ),
            ProfitFactor_Calculation AS (
                SELECT
                    3 AS RowN, 
                    Email as User,
                    'Profit Factor' AS Performance,
                    SUM(CASE WHEN Profit > 0 THEN Profit ELSE 0 END) / NULLIF(SUM(CASE WHEN Profit <= 0 THEN Profit ELSE 0 END) * -1, 0) AS All_Trades,
                    SUM(CASE WHEN Profit > 0 AND Market_pos_ = 'Long' THEN Profit ELSE 0 END) / NULLIF(SUM(CASE WHEN Profit <= 0 AND Market_pos_ = 'Long' THEN Profit ELSE 0 END) * -1, 0) AS Longs,
                    SUM(CASE WHEN Profit > 0 AND Market_pos_ = 'Short' THEN Profit ELSE 0 END) / NULLIF(SUM(CASE WHEN Profit <= 0 AND Market_pos_ = 'Short' THEN Profit ELSE 0 END) * -1, 0) AS Shorts
                FROM Filtered_Trades
                GROUP BY Email
            ),
            AvgWinTrade_Calculation AS (
                SELECT
                    4 AS RowN, 
                    Email as User,
                    'Avg Win Trade' AS Performance,
                    SUM(CASE WHEN Profit > 0 THEN Profit ELSE 0 END) / COUNT(CASE WHEN Profit > 0 THEN Profit ELSE 0 END) AS All_Trades,
                    SUM(CASE WHEN Profit > 0 AND Market_pos_ = 'Long' THEN Profit ELSE 0 END) / COUNT(CASE WHEN Profit > 0 AND Market_pos_ = 'Long' THEN Profit ELSE 0 END) AS Longs,
                    SUM(CASE WHEN Profit > 0 AND Market_pos_ = 'Short' THEN Profit ELSE 0 END) / COUNT(CASE WHEN Profit > 0 AND Market_pos_ = 'Short' THEN Profit ELSE 0 END) AS Shorts
                FROM Filtered_Trades
                GROUP BY Email
            ),
            AvgLosseTrade_Calculation AS (
                SELECT
                    5 AS RowN, 
                    Email as User,
                    'Avg Losse Trade' AS Performance,
                    SUM(CASE WHEN Profit <= 0 THEN Profit ELSE 0 END) / COUNT(CASE WHEN Profit <= 0 THEN Profit ELSE 0 END) AS All_Trades,
                    SUM(CASE WHEN Profit <= 0 AND Market_pos_ = 'Long' THEN Profit ELSE 0 END) / COUNT(CASE WHEN Profit <= 0 AND Market_pos_ = 'Long' THEN Profit ELSE 0 END) AS Longs,
                    SUM(CASE WHEN Profit <= 0 AND Market_pos_ = 'Short' THEN Profit ELSE 0 END) / COUNT(CASE WHEN Profit <= 0 AND Market_pos_ = 'Short' THEN Profit ELSE 0 END) AS Shorts
                FROM Filtered_Trades
                GROUP BY Email
            ),
            Trade_Flags AS (
                SELECT 
                    Email,
                    Entry_time,
                    CASE WHEN Profit > 0 THEN 1 ELSE 0 END AS Flag,
                    CASE WHEN Profit > 0 AND Market_pos_ = 'Long' THEN 1 ELSE 0 END AS Flag_Long,
                    CASE WHEN Profit > 0 AND Market_pos_ = 'Short' THEN 1 ELSE 0 END AS Flag_Short
                FROM Filtered_Trades
                ORDER BY Entry_time ASC
            ),
            Flag_Changes AS (
                SELECT
                    Email,
                    Entry_time,
                    Flag,
                    Flag_Long,
                    Flag_Short,
                    LAG(Flag, 1, 0) OVER (PARTITION BY Email ORDER BY Entry_time) AS Prev_Flag,
                    LAG(Flag_Long, 1, 0) OVER (PARTITION BY Email ORDER BY Entry_time) AS Prev_Flag_Long,
                    LAG(Flag_Short, 1, 0) OVER (PARTITION BY Email ORDER BY Entry_time) AS Prev_Flag_Short,
                    ROW_NUMBER() OVER (PARTITION BY Email ORDER BY Entry_time) AS Row_Num
                FROM Trade_Flags
            ),
            Streaks AS (
                SELECT
                    Email,
                    Entry_time,
                    Flag,
                    Prev_Flag_Long,
                    Prev_Flag_Short,
                    Row_Num,
                    SUM(CASE WHEN Flag = 1 AND Prev_Flag = 0 THEN 1 ELSE 0 END) OVER (PARTITION BY Email ORDER BY Row_Num) AS Streak_Start,
                    SUM(CASE WHEN Flag = 1 AND Prev_Flag_Long = 0 THEN 1 ELSE 0 END) OVER (PARTITION BY Email ORDER BY Row_Num) AS Streak_Start_Long,
                    SUM(CASE WHEN Flag = 1 AND Prev_Flag_Short = 0 THEN 1 ELSE 0 END) OVER (PARTITION BY Email ORDER BY Row_Num) AS Streak_Start_Short
                FROM Flag_Changes
            ),
            Consecutive_Streaks AS (
                SELECT
                    Email,
                    Entry_time,
                    Flag,
                    Prev_Flag_Long,
                    Prev_Flag_Short,
                    Row_Num,
                    Streak_Start,
                    Streak_Start_Long,
                    Streak_Start_Short,
                    ROW_NUMBER() OVER (PARTITION BY Email, Streak_Start ORDER BY Row_Num) AS Streak_Length,
                    ROW_NUMBER() OVER (PARTITION BY Email, Streak_Start_Long ORDER BY Row_Num) AS Streak_Length_Long,
                    ROW_NUMBER() OVER (PARTITION BY Email, Streak_Start_Short ORDER BY Row_Num) AS Streak_Length_Short
                FROM Streaks
                WHERE Flag = 1
            ),
            MaxConsecutive_Winner AS (
                SELECT
                    6 AS RowN, 
                    Email AS User,
                    'Max. Concsec. Win' AS Performance,
                    MAX(Streak_Length) AS All_Trades,
                    MAX(Streak_Length_Long) AS Longs,
                    MAX(Streak_Length_Short) AS Shorts
                FROM Consecutive_Streaks
                GROUP BY Email
                ORDER BY All_Trades DESC
            ),
            Trade_Flags_Lose AS (
                SELECT 
                    Email,
                    Entry_time,
                    CASE WHEN Profit < 0 THEN 1 ELSE 0 END AS Flag,
                    CASE WHEN Profit < 0 AND Market_pos_ = 'Long' THEN 1 ELSE 0 END AS Flag_Long,
                    CASE WHEN Profit < 0 AND Market_pos_ = 'Short' THEN 1 ELSE 0 END AS Flag_Short
                FROM Filtered_Trades
                ORDER BY Entry_time ASC
            ),
            Flag_Changes_Lose AS (
                SELECT
                    Email,
                    Entry_time,
                    Flag,
                    Flag_Long,
                    Flag_Short,
                    LAG(Flag, 1, 0) OVER (PARTITION BY Email ORDER BY Entry_time) AS Prev_Flag,
                    LAG(Flag_Long, 1, 0) OVER (PARTITION BY Email ORDER BY Entry_time) AS Prev_Flag_Long,
                    LAG(Flag_Short, 1, 0) OVER (PARTITION BY Email ORDER BY Entry_time) AS Prev_Flag_Short,
                    ROW_NUMBER() OVER (PARTITION BY Email ORDER BY Entry_time) AS Row_Num
                FROM Trade_Flags_Lose
            ),
            Streaks_Lose AS (
                SELECT
                    Email,
                    Entry_time,
                    Flag,
                    Prev_Flag_Long,
                    Prev_Flag_Short,
                    Row_Num,
                    SUM(CASE WHEN Flag = 1 AND Prev_Flag = 0 THEN 1 ELSE 0 END) OVER (PARTITION BY Email ORDER BY Row_Num) AS Streak_Start,
                    SUM(CASE WHEN Flag = 1 AND Prev_Flag_Long = 0 THEN 1 ELSE 0 END) OVER (PARTITION BY Email ORDER BY Row_Num) AS Streak_Start_Long,
                    SUM(CASE WHEN Flag = 1 AND Prev_Flag_Short = 0 THEN 1 ELSE 0 END) OVER (PARTITION BY Email ORDER BY Row_Num) AS Streak_Start_Short
                FROM Flag_Changes_Lose
            ),
            Consecutive_Streaks_Lose AS (
                SELECT
                    Email,
                    Entry_time,
                    Flag,
                    Prev_Flag_Long,
                    Prev_Flag_Short,
                    Row_Num,
                    Streak_Start,
                    Streak_Start_Long,
                    Streak_Start_Short,
                    ROW_NUMBER() OVER (PARTITION BY Email, Streak_Start ORDER BY Row_Num) AS Streak_Length,
                    ROW_NUMBER() OVER (PARTITION BY Email, Streak_Start_Long ORDER BY Row_Num) AS Streak_Length_Long,
                    ROW_NUMBER() OVER (PARTITION BY Email, Streak_Start_Short ORDER BY Row_Num) AS Streak_Length_Short
                FROM Streaks_Lose
                WHERE Flag = 1
            ),
            MaxConsecutive_Lose AS (
                SELECT
                    7 AS RowN, 
                    Email AS User,
                    'Max. Concsec. Lose' AS Performance,
                    MAX(Streak_Length) AS All_Trades,
                    MAX(Streak_Length_Long) AS Longs,
                    MAX(Streak_Length_Short) AS Shorts
                FROM Consecutive_Streaks_Lose
                GROUP BY Email
                ORDER BY All_Trades DESC
            ),
            LargestWin_Trade AS (
                SELECT
                    8 AS RowN, 
                    Email as User,
                    'Largest Win Trade' AS Performance,
                    MAX(Profit) AS All_Trades,
                    MAX(CASE WHEN Market_pos_ = 'Long' THEN Profit ELSE 0 END) AS Longs,
                    MAX(CASE WHEN Market_pos_ = 'Short' THEN Profit ELSE 0 END) AS Shorts
                FROM Filtered_Trades
                GROUP BY Email
            ),
            LargestLose_Trade AS (
                SELECT
                    9 AS RowN, 
                    Email as User,
                    'Largest Lose Trade' AS Performance,
                    MIN(Profit) AS All_Trades,
                    MIN(CASE WHEN Market_pos_ = 'Long' THEN Profit ELSE 0 END) AS Longs,
                    MIN(CASE WHEN Market_pos_ = 'Short' THEN Profit ELSE 0 END) AS Shorts
                FROM Filtered_Trades
                GROUP BY Email
            ),
            Trade_Durations AS (
                SELECT
                    Email,
                    Market_pos_,
                    TIMESTAMP_DIFF(Exit_time, Entry_time, MINUTE) AS Duration_Minutes
                FROM Filtered_Trades
            ),
            Avg_Durations AS (
                SELECT
                    10 AS RowN, 
                    Email AS User,
                    'Avg Time in Market' AS Performance,
                    AVG(Duration_Minutes) AS All_Trades,
                    AVG(CASE WHEN Market_pos_ = 'Long' THEN Duration_Minutes ELSE NULL END) AS Longs,
                    AVG(CASE WHEN Market_pos_ = 'Short' THEN Duration_Minutes ELSE NULL END) AS Shorts
                FROM Trade_Durations
                GROUP BY Email
            ),
            Daily_Profits AS (
                SELECT
                    Email,
                    DATE(Entry_time) AS Entry_date,
                    SUM(Profit) AS Daily_Profit, 
                    SUM(CASE WHEN Market_pos_ = 'Long' THEN Profit ELSE 0 END) AS Daily_Profit_Long,
                    SUM(CASE WHEN Market_pos_ = 'Short' THEN Profit ELSE 0 END) AS Daily_Profit_Short
                FROM Filtered_Trades
                GROUP BY Email, Entry_date
            ),
            Daily_Balances AS (
                SELECT
                    Email,
                    Entry_date,
                    Daily_Profit,
                    Daily_Profit_Long,
                    Daily_Profit_Short,
                    SUM(Daily_Profit) OVER (PARTITION BY Email ORDER BY Entry_date) AS Cumulative_Balance,
                    SUM(Daily_Profit_Long) OVER (PARTITION BY Email ORDER BY Entry_date) AS Cumulative_Balance_Long,
                    SUM(Daily_Profit_Short) OVER (PARTITION BY Email ORDER BY Entry_date) AS Cumulative_Balance_Short
                FROM Daily_Profits
            ),
            Max_Balances AS (
                SELECT
                    Email,
                    Entry_date,
                    Daily_Profit,
                    Daily_Profit_Long,
                    Daily_Profit_Short,
                    Cumulative_Balance,
                    Cumulative_Balance_Long,
                    Cumulative_Balance_Short,
                    MAX(Cumulative_Balance) OVER (PARTITION BY Email ORDER BY Entry_date ROWS BETWEEN UNBOUNDED PRECEDING AND CURRENT ROW) AS Max_Balance,
                    MAX(Cumulative_Balance_Long) OVER (PARTITION BY Email ORDER BY Entry_date ROWS BETWEEN UNBOUNDED PRECEDING AND CURRENT ROW) AS Max_Balance_Long,
                    MAX(Cumulative_Balance_Short) OVER (PARTITION BY Email ORDER BY Entry_date ROWS BETWEEN UNBOUNDED PRECEDING AND CURRENT ROW) AS Max_Balance_Short
                FROM Daily_Balances
            ),
            Drawdown_Periods AS (
                SELECT
                    Email,
                    Entry_date,
                    Cumulative_Balance,
                    Cumulative_Balance_Long,
                    Cumulative_Balance_Short,
                    Max_Balance,
                    Max_Balance_Long,
                    Max_Balance_Short,
                    CASE WHEN Cumulative_Balance < Max_Balance THEN 1 ELSE 0 END AS In_Drawdown,
                    CASE WHEN Cumulative_Balance_Long < Max_Balance_Long THEN 1 ELSE 0 END AS In_Drawdown_Long,
                    CASE WHEN Cumulative_Balance_Short < Max_Balance_Short THEN 1 ELSE 0 END AS In_Drawdown_Short
                FROM Max_Balances
            ),
            Drawdown_Streaks AS (
                SELECT
                    Email,
                    Entry_date,
                    In_Drawdown,
                    In_Drawdown_Long,
                    In_Drawdown_Short,
                    ROW_NUMBER() OVER (PARTITION BY Email ORDER BY Entry_date) AS Row_Num,
                    SUM(CASE WHEN In_Drawdown = 0 THEN 1 ELSE 0 END) OVER (PARTITION BY Email ORDER BY Entry_date) AS Streak_ID,
                    SUM(CASE WHEN In_Drawdown_Long = 0 THEN 1 ELSE 0 END) OVER (PARTITION BY Email ORDER BY Entry_date) AS Streak_ID_Long,
                    SUM(CASE WHEN In_Drawdown_Short = 0 THEN 1 ELSE 0 END) OVER (PARTITION BY Email ORDER BY Entry_date) AS Streak_ID_Short
                FROM Drawdown_Periods
            ),
            Drawdown_Durations AS (
                SELECT
                    Email,
                    'AllTrades' AS Type,
                    Streak_ID,
                    MIN(Entry_date) AS Start_Date,
                    MAX(Entry_date) AS End_Date,
                    COUNT(*) AS Duration_Days
                FROM Drawdown_Streaks
                WHERE In_Drawdown = 1
                GROUP BY Email, Streak_ID
                UNION ALL
                SELECT
                    Email,
                    'Longs' AS Type,
                    Streak_ID_Long AS Streak_ID,
                    MIN(Entry_date) AS Start_Date,
                    MAX(Entry_date) AS End_Date,
                    COUNT(*) AS Duration_Days
                FROM Drawdown_Streaks
                WHERE In_Drawdown_Long = 1
                GROUP BY Email, Streak_ID_Long
                UNION ALL
                SELECT
                    Email,
                    'Shorts' AS Type,
                    Streak_ID_Short AS Streak_ID,
                    MIN(Entry_date) AS Start_Date,
                    MAX(Entry_date) AS End_Date,
                    COUNT(*) AS Duration_Days
                FROM Drawdown_Streaks
                WHERE In_Drawdown_Short = 1
                GROUP BY Email, Streak_ID_Short
            ),
            Avg_Drawdown_Durations AS (
                SELECT
                    Email,
                    Type,
                    AVG(Duration_Days) AS Avg_Drawdown_Duration
                FROM Drawdown_Durations
                GROUP BY Email, Type
            ),
            TimeRecover_Table AS (
            SELECT
                11 AS RowN,
                Email AS User,
                'Max Time to Recover' AS Performance,
                MAX(CASE WHEN Type = 'AllTrades' THEN Avg_Drawdown_Duration ELSE 0 END) AS All_Trades,
                MAX(CASE WHEN Type = 'Longs' THEN Avg_Drawdown_Duration ELSE 0 END) AS Longs,
                MAX(CASE WHEN Type = 'Shorts' THEN Avg_Drawdown_Duration ELSE 0 END) AS Shorts
            FROM Avg_Drawdown_Durations
            GROUP BY Email
            )
            SELECT
                RowN,
                User,
                Performance,
                All_Trades,
                Longs,
                Shorts
            FROM Profit_Summary
            UNION ALL
            SELECT
                RowN,
                User,
                Performance,
                All_Trades,
                Longs,
                Shorts
            FROM Drawdown_Calculation
            UNION ALL
            SELECT
                RowN,
                User,
                Performance,
                All_Trades,
                Longs,
                Shorts
            FROM ProfitFactor_Calculation
            UNION ALL
            SELECT
                RowN,
                User,
                Performance,
                All_Trades,
                Longs,
                Shorts
            FROM AvgWinTrade_Calculation
            UNION ALL
            SELECT
                RowN,
                User,
                Performance,
                All_Trades,
                Longs,
                Shorts
            FROM AvgLosseTrade_Calculation    
            UNION ALL
            SELECT
                RowN,
                User,
                Performance,
                All_Trades,
                Longs,
                Shorts
            FROM MaxConsecutive_Winner
            UNION ALL
            SELECT
                RowN,
                User,
                Performance,
                All_Trades,
                Longs,
                Shorts
            FROM MaxConsecutive_Lose
            UNION ALL
            SELECT
                RowN,
                User,
                Performance,
                All_Trades,
                Longs,
                Shorts
            FROM LargestWin_Trade
            UNION ALL
            SELECT
                RowN,
                User,
                Performance,
                All_Trades,
                Longs,
                Shorts
            FROM LargestLose_Trade
            UNION ALL
            SELECT
                RowN,
                User,
                Performance,
                All_Trades,
                Longs,
                Shorts
            FROM Avg_Durations
            UNION ALL
            SELECT
                RowN,
                User,
                Performance,
                All_Trades,
                Longs,
                Shorts
            FROM TimeRecover_Table
            ORDER BY RowN;
        ";

        $results = $this->bigQueryService->runQuery($query);

        $resultsArray = [];
        foreach ($results as $row) {
            $resultsArray[] = $row;
        }
        
        return response()->json($resultsArray);     
    }

    public function getRecentTrades(Request $request){   
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

        $query = "
        WITH Latest_Trades AS (
            SELECT 
                    Email AS User,
                    DATE(Entry_Time) AS Entry_Time,
                    COUNT(*) AS Trade_Count,
                    SUM(CAST(Profit AS FLOAT64)) AS Total_PNL 
                FROM 
                    `algolabreport.NewData.Total_Trades` AS T
                ".$whereAccount."
                ".$whereDate." 
                ".$whereMarket_pos."
                ".$whereTrade_Result."
                GROUP BY 
                    User,Entry_Time
            ),
            Top_10_Dates AS (
                SELECT 
                    User,
                    Entry_Time,
                    Trade_Count,
                    Total_PNL,
                    ROW_NUMBER() OVER (ORDER BY Entry_Time DESC) AS Row_Num
                FROM 
                    Latest_Trades
            )
            SELECT
                User,
                FORMAT_TIMESTAMP('%Y-%m-%d', TIMESTAMP(Entry_Time)) AS Date,
                Trade_Count,
                Total_PNL
            FROM 
                Top_10_Dates
            WHERE 
                Row_Num <= 10
            ORDER BY 
                Entry_Time DESC;

        ";

        $results = $this->bigQueryService->runQuery($query);

        $resultsArray = [];
        foreach ($results as $row) {
            $resultsArray[] = $row;
        }
        
        return response()->json($resultsArray);     
    }

    public function getTradesForDirection(Request $request){   
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

        $query = "

        SELECT
            Email AS User, 
            Account,
            Instrument,
            Market_pos_ AS Direction, 
            COUNT(CASE WHEN Trade_Result = 'Win' THEN 1 END) AS Win,
            COUNT(CASE WHEN Trade_Result = 'Loss' THEN 1 END) AS Loss, 
            COUNT(Entry_time) AS Q_Trades,
            COUNT(CASE WHEN Trade_Result = 'Win' THEN 1 END)/COUNT(Entry_time) AS WinRatio,
            COUNT(CASE WHEN Trade_Result = 'Loss' THEN 1 END)/COUNT(Entry_time) AS LossRatio
        FROM
            `algolabreport.NewData.Total_Trades`
           ".$whereAccount."
            ".$whereDate." 
            ".$whereMarket_pos."
            ".$whereTrade_Result."
        GROUP BY
            Email, Account, Instrument, Market_pos_
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
