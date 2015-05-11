<?php
/**
 * Project: BrokingClub | LevelManager.php
 * Author: Simon - www.triggerdesign.de
 * Date: 11.05.2015
 * Time: 15:22
 *
 */

namespace BrokingClub\RolePlay;


class LevelManager {

    private $dispatcher;

    /**
     * @param $level
     * @return int
     */
    public function expForLevel($level){
        return ceil((($level ^ 2) * 4) + 50);
    }

    /**
     * @param $exp
     * @return int
     */
    public function levelForExp($exp){
        return floor(sqrt(($exp - 50) / 4));
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