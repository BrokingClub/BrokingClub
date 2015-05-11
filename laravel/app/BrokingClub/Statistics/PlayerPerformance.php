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

class PlayerPerformance extends ObjectCache
{

    public function leaderBoard(){

        $recentSales = $this->recentSales();

        debug($recentSales);

    }


    public function recentSales($days = 30, $cached = true)
    {
        if (!$cached) {
            return Purchase::where('updated_at', '<', Carbon::now())
                ->where('updated_at', '>', Carbon::now()->subDays($days))
                ->where('mode', '=', 'sold')->limit(9999);
        }

        return $this->getOrStore('recentSales.' . $days,
            function () use ($days) {
                return $this->recentSales($days, false);
            });
    }


} 