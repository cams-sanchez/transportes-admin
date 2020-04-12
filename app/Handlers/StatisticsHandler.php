<?php


namespace App\Handlers;


use App\Constants\StatusConstants;
use App\Helpers\StatisticsHelper;
use Illuminate\Support\Facades\Log;

class StatisticsHandler
{

    /** @var StatisticsHelper $staticticsHelper */
    protected $statisticsHelper;

    /**
     * StaticticsHandler constructor.
     * @param StatisticsHelper $statisticsHelper
     */
    public function __construct(StatisticsHelper $statisticsHelper)
    {
        $this->statisticsHelper = $statisticsHelper;
    }

    public function getFoundTirosStatistics(object $tirosFound): array
    {
        $statictics = [];

        if(!empty($tirosFound)) {
            Log::debug("We have found Tiros and getting their statistics");
            $statictics[StatusConstants::ACTIVE_STATUS] = $this->statisticsHelper->countStatusFromResults(
                $tirosFound,
                StatusConstants::ACTIVE_STATUS);

            $statictics[StatusConstants::TIRO_DONE] = $this->statisticsHelper->countStatusFromResults(
                $tirosFound,
                StatusConstants::TIRO_DONE);

            $statictics[StatusConstants::BLOCKED_STATUS] = $this->statisticsHelper->countStatusFromResults(
                $tirosFound,
                StatusConstants::BLOCKED_STATUS);

            $statictics['totalTirosFound'] = $this->statisticsHelper->countResults($tirosFound);
        }

        return $statictics;
    }

}
