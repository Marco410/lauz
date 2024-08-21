<?php

namespace App\Services;

use Google\Cloud\BigQuery\BigQueryClient;
use Google\Cloud\Core\ExponentialBackoff;

class BigQueryService
{

    public function __construct()
    {
    }
    /**
     * Runs a query on Google BigQuery using the provided query string.
     *
     * @param string $query The SQL query to be executed on Google BigQuery.
     *
     * @return array|null The results of the executed query, or null if the query fails.
    */
    public function runQuery($query)
    {
        putenv('GOOGLE_APPLICATION_CREDENTIALS='.storage_path('google-credentials.json'));
        $projectId = 'algolabreport';
        $bigQuery = new BigQueryClient([
            'projectId' => $projectId,
        ]);
        $jobConfig = $bigQuery->query($query);
        $job = $bigQuery->startQuery($jobConfig);

        $backoff = new ExponentialBackoff(10);
        $backoff->execute(function () use ($job) {
            $job->reload();
            if (!$job->isComplete()) {
            }
        });

        $queryResults = $job->queryResults();

        return $queryResults;
    }
}
