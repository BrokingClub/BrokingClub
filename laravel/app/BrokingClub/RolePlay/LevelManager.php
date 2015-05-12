<?php
/**
 * Project: BrokingClub | LevelManager.php
 * Author: Simon - www.triggerdesign.de
 * Date: 11.05.2015
 * Time: 15:22
 *
 */

namespace BrokingClub\RolePlay;


use App;

class LevelManager {

    /**
     * @var Notifier
     */
    private $notifier;

    private $dispatcher;

    public function __construct(){
        $this->notifier = App::make('RolePlayNotifier');
    }

    /**
     * @param $level
     * @return int
     */
    public function expForLevel($level){
        $levels = \Config::get('brokingclub.levels');

        if(isset($levels[$level]))
            return $levels[$level];

        return 9 * 10^6;

    }

    /**
     * @param $exp
     * @return int
     */
    public function levelForExp($exp){
        for($i = 0; $i != 100; $i++){
            if($this->expForLevel($i) > $exp && $i > 0) return $i-1;
        }

        return 0;

    }


    public function onExpAdded($player, $expAdded){
        $oldLevel = $player->level;

        $newLevel = $this->levelForExp($player->exp);


        if($oldLevel != $newLevel)
            $this->levelUp($player, $newLevel);
    }

    private function levelUp($player, $newLevel){

        $oldLevel = $player->level;

        $player->level = $newLevel;
        $player->save();

        \Event::fire('roleplay.level.up', [$player, $oldLevel, $newLevel]);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @return array
     */
    public function subscribe($dispatcher){

        $this->dispatcher = $dispatcher;

        $this->listenTo('roleplay.exp.added', 'onExpAdded');


    }


    private function listenTo($event, $action){
        $this->dispatcher->listen($event, 'BrokingClub\RolePlay\LevelManager@' . $action);
    }

} 