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


    public function getDailyNetCumulativePL(Request $request){   
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

}
