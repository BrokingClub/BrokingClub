<?php
/**
 * Project: BrokingClub | StockMarket.php
 * Author: Simon - www.triggerdesign.de
 * Date: 30.04.2015
 * Time: 22:46
 */

namespace BrokingClub\Statistics;


use StockValue;

class MarketLogic {

    /**
     * @param StockValue[] $stockValues
     * @return float
     */
    public function changeRate($stockValues)
    {

        if($stockValues->count() < 2) return 0;



        $newestValue = $stockValues->first()->value;
        $oldestValue = $stockValues->last()->value;

        $change = $newestValue / $oldestValue;

        return $change;
    }

    /**
     * @param $stockValues
     * @param bool $asString
     * @return float|string
     */
    public function changeRatePercent($stockValues, $asString = false)
    {
        $changeRate = $this->changeRate($stockValues);

        $changeRatePercent = round(($changeRate - 1) * 100, 3);

        if (!$asString)
            return $changeRatePercent;
        else
            return $changeRatePercent . '%';
    }

    /**
     * @param $stockValues
     * @return string
     */
    public function changeRateMode($stockValues){
        $percent = $this->changeRatePercent($stockValues);

        if ($percent == 0) return "neutral";
        return ($percent > 0) ? "rising" : "falling";
    }
} 