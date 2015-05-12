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

    public static $days = 60;

    /**
     * @var LeaderBoardEntry[]
     */
    private $entries;

    /**
     * Calculate which entries we will render
     */
    public function calculate(){

        $recentSales = $this->recentSales(static::$days);
        $this->entries = LeaderBoardEntry::entries($recentSales);
        $this->entries->sortBy('performance', SORT_REGULAR, true);

        $this->performanceSteps($this->entries->first()->performance);
    }

    private function performanceSteps($maximum){
        foreach($this->entries as $entry){
            $entry->steppedPerformance($maximum);
        }
    }

    /**
     * @return LeaderBoardEntry[]
     */
    public function getEntries(){
        return $this->entries->values();
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