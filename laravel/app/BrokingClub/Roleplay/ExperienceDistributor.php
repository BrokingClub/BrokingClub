<?php
/**
 * Project: BrokingClub | Experience.php
 * Author: Simon - www.triggerdesign.de
 * Date: 11.05.2015
 * Time: 15:22
 */

namespace BrokingClub\RolePlay;


class ExperienceDistributor {

    public function addPoints($amount){
        $player = Player::auth();

        if(!$player) return false;
        if($amount < 1) return false;

        $player->exp += $amount;
        $player->save();

        return true;
    }
} 