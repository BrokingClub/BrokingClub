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
        return ceil((($level ^ 2) * 4) + 10);
    }

    /**
     * @param $exp
     * @return int
     */
    public function levelForExp($exp){
        if($exp < 10) return 1;

        $level = floor(sqrt(($exp - 10) / 4));
        if($level == 0) $level = 1;

        return $level;

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