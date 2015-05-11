<?php
/**
 * Project: BrokingClub | Experience.php
 * Author: Simon - www.triggerdesign.de
 * Date: 11.05.2015
 * Time: 15:22
 * 
 *
 */

namespace BrokingClub\RolePlay;


use App;
use Event;
use Player;
use Purchase;

class ExperienceDistributor {

    /**
     * @var Notifier
     */
    private $notifier;

    private $dispatcher;

    public function __construct(){
        $this->notifier = App::make('RolePlayNotifier');
    }


    public function onStocksSold(Purchase $purchase){
        $moneyMade = $purchase->resale()->grossEarned();

        if($moneyMade < 0) return false;

        $exp = floor($moneyMade / 200);

        return $this->addPoints($exp, "Winning " + $moneyMade + "$ by trading stocks.");


    }

    public function onStocksPurchased(Purchase $purchase){
        $moneySpent = $purchase->bill()->getTotal();


        $exp = floor($moneySpent / 2000);

        return $this->addPoints($exp, "Spending " + $moneySpent + "$ on stocks.");

    }

    /**
     * @param $amount
     * @param string $reason
     * @return bool
     */
    public function addPoints($amount, $reason = "No reason."){
        if($amount < 0) return false;

        $player = Player::auth();

        if(!$player) return false;
        if($amount < 1) return false;

        $player->exp += $amount;
        $player->save();


        Event::fire('roleplay.exp.added', [$player, $amount, $reason]);

        return true;
    }



    /**
     * Register the listeners for the subscriber.
     *
     * @return array
     */
    public function subscribe($dispatcher){

        $this->dispatcher = $dispatcher;

        $this->listenTo('stocks.sold', 'onStocksSold');
        $this->listenTo('stocks.purchased', 'onStocksPurchased');

    }


    private function listenTo($event, $action){
        $this->dispatcher->listen($event, 'BrokingClub\RolePlay\ExperienceDistributor@' . $action);
    }
} 