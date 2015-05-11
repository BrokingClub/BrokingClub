<?php
/**
 * Project: BrokingClub | Experience.php
 * Author: Simon - www.triggerdesign.de
 * Date: 11.05.2015
 * Time: 15:22
 */

namespace BrokingClub\RolePlay;


use Event;

class ExperienceDistributor {

    private $dispatcher;


    public function onStocksSold(Purchase $purchase){


    }

    public function onStocksPurchased(Purchase $purchase){

    }

    public function onEventsCreated($hello){
    }


    /**
     * @param $amount
     * @param string $reason
     * @return bool
     */
    public function addPoints($amount, $reason = "No reason."){
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

        $this->listenTo('events.created', 'onEventsCreated');
        $this->listenTo('stocks.sold', 'onStocksSold');
        $this->listenTo('stocks.purchased', 'onStocksPurchased');

    }


    private function listenTo($event, $action){
        $this->dispatcher->listen($event, 'BrokingClub\RolePlay\ExperienceDistributor@' . $action);
    }
} 