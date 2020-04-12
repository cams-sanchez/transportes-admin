<?php


namespace App\Helpers;


use Illuminate\Support\Facades\Log;

class StatisticsHelper
{
    public function countStatusFromResults(object $results, string $valueToSearch)
    {
        $valueToReturn = 0;

        foreach ($results as $result) {
            //Log::debug("RESUlT ".print_r($result->status,1));
            if ($result->status === $valueToSearch) {
                $valueToReturn++;
            }
        }

        Log::debug("Value to Return $valueToReturn for $valueToSearch");
        return $valueToReturn;
    }

    public function countResults(object $results)
    {
        return count($results->toArray());
    }
}
