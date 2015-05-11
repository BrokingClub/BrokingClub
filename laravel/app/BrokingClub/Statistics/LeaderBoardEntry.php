<?php
/**
 * Project: BrokingClub | LeaderBoardEntry.php
 * Author: Simon - www.triggerdesign.de
 * Date: 11.05.2015
 * Time: 22:15
 */

namespace BrokingClub\Statistics;


use BrokingClub\Repositories\PlayerRepository;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;

class LeaderBoardEntry {
    public $player;

    /**
     * @var Collection
     */
    public $sales;

    /**
     * @var float
     */
    public $performance;

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

        $this->sales = new Collection($sales);

        $this->performance = $this->calculate();
    }

    private function calculate(){
        $performance = 0;

        /** @var \Purchase $purchase */
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
            $entries[$playerId] = new LeaderBoardEntry($playerId, $playersSales);
        }

        return $entries;
    }
} 