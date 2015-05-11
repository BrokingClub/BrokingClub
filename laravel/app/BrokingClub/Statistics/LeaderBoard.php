<?php
/**
 * Project: BrokingClub | PlayerPerformance.php
 * Author: Simon - www.triggerdesign.de
 * Date: 11.05.2015
 * Time: 21:36
 */

namespace BrokingClub\Statistics;


use BrokingClub\Cache\ObjectCache;
use Carbon\Carbon;
use Purchase;

class LeaderBoard extends ObjectCache
{

    public function calculate(){

        $recentSales = $this->recentSales();
        $entries = LeaderBoardEntry::entries($recentSales);

    }


    /**
     * @param int $days
     * @param bool $cached
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function recentSales($days = 60, $cached = true)
    {
        if (!$cached) {
            return Purchase::where('updated_at', '<', Carbon::now())
                ->where('updated_at', '>', Carbon::now()->subDays($days))
                ->limit(9999)->get();
        }

        return $this->getOrStore('recentSales.' . $days,
            function () use ($days) {
                return $this->recentSales($days, false);
            });
    }


} 