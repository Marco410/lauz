<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Google\Cloud\BigQuery\BigQueryClient;
use Google\Cloud\Core\ExponentialBackoff;

class BigQueryController extends Controller
{
    public function test()
    {
        putenv('GOOGLE_APPLICATION_CREDENTIALS='.storage_path('google-credentials.json'));
        $projectId = 'algolabreport';
        $query = "SELECT Instrument, EXTRACT(YEAR FROM Entry_Time) AS Year, EXTRACT(MONTH FROM Entry_Time) AS Month, EXTRACT(WEEK FROM Entry_Time) AS Week, EXTRACT(DAYOFYEAR FROM Entry_Time) AS Day, EXTRACT(HOUR FROM Entry_Time) AS Hour, CONCAT(EXTRACT(HOUR FROM Entry_Time), ':', CASE  WHEN EXTRACT(MINUTE FROM Entry_Time) <= 29 THEN '00' ELSE '30' END) AS Half_Hour, SUM(Profit) AS NetPL FROM `algolabreport.NewData.Total_Trades` GROUP BY Instrument, Year, Month, Week, Day, Hour, Half_Hour ORDER BY Instrument, Year, Month, Week, Day, Hour, Half_Hour;";

        $bigQuery = new BigQueryClient([
            'projectId' => $projectId,
        ]);
        $jobConfig = $bigQuery->query($query);
        $job = $bigQuery->startQuery($jobConfig);

        $backoff = new ExponentialBackoff(10);
        $backoff->execute(function () use ($job) {
            print('Waiting for job to complete' . PHP_EOL);
            $job->reload();
            if (!$job->isComplete()) {
                throw new Exception('Job has not yet completed', 500);
            }
        });
        $queryResults = $job->queryResults();

        return $queryResults;
    }

}
