<?php
/**
 * Project: BrokingClub | LeaderBoardEntry.php
 * Author: Simon - www.triggerdesign.de
 * Date: 11.05.2015
 * Time: 22:15
 */

namespace BrokingClub\Statistics;


use BrokingClub\Repositories\PlayerRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;
use Purchase;

class LeaderBoardEntry {
    /**
     * @var \Player
     */
    public $player;

    /**
     * @var Purchase[]
     */
    public $sales;

    /**
     * @var float
     */
    public $performance;

    /**
     * @var float
     */
    public $steppedPerformance;

    /**
     * @var PlayerRepository
     */
    private $playerRepository;


    /**
     * @param int $playerId
     * @param array $sales
     */
    public function __construct($playerId, $sales){
        $this->playerRepository = \App::make('PlayerRepository');

        $this->player = $this->playerRepository->findById($playerId);

        $this->sales = $sales;

        $this->performance = $this->calculate();

        $this->steppedPerformance = $this->steppedPerformance();

    }


    private function steppedPerformance(){
        $start = Carbon::now()->subDays(LeaderBoard::$days);
        $end = Carbon::now();

        $stepDay = $start->copy();

        $dailyPerformances = [];

        for($i = 0; $i != LeaderBoard::$days; $i++){
            $stepDay->addDay();

            $dailyPerformances[$i] = 0;

            /** @var Purchase $sale */
            foreach($this->sales as $sale){


                if($stepDay->lte($sale->created_at))
                    break;



                $dailyPerformances[$i] += $sale->resale()->grossEarned();
            }
        }

        debug($dailyPerformances);

        return $dailyPerformances;


    }

    private function calculate(){
        $performance = 0;

        foreach($this->sales as $purchase){
            $performance += $purchase->resale()->grossEarned();
        }

        return $performance;
    }

    /**
     * @param EloquentCollection $allSales
     */
    public static function entries($allSales){
        $playersSales = $allSales->groupBy('player_id');

        $entries = new Collection();

        foreach($playersSales as $playerId => $playerSales){
            $entries[$playerId] = new LeaderBoardEntry($playerId, $playerSales);
        }


        return $entries;
    }
} 