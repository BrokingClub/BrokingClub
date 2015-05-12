<?php
/**
 * Project: BrokingClub | DebugController.php
 * Author: Simon - www.triggerdesign.de
 * Date: 10.05.2015
 * Time: 16:47
 */

class DebugController extends Controller{

    public function getPurchase(){
        $purchase = Purchase::find(23);

        var_dump($purchase);

    }

    public function getLevels(){

        $levelManager = new \BrokingClub\RolePlay\LevelManager();

        echo $levelManager->expForLevel(1) . "<br/>";
        echo $levelManager->expForLevel(2) . "<br/>";
        echo $levelManager->expForLevel(3) . "<br/>";
        echo $levelManager->expForLevel(4) . "<br/>";
        echo $levelManager->expForLevel(5) . "<br/>";

        echo "<br/>";

        echo $levelManager->levelForExp(0) . "<br/>";
        echo $levelManager->levelForExp(1). "<br/>";
        echo $levelManager->levelForExp(10). "<br/>";
        echo $levelManager->levelForExp(30). "<br/>";
        echo $levelManager->levelForExp(5000). "<br/>";

    }

    public function getRichsimon(){
        $player = Player::find(9);

        foreach($player->sold as $purchase){
            if($purchase->mode == "sold" && $purchase->earned > 1){
                echo "Revived purchase " . $purchase->id . " " . $purchase->earned . "€";


                $purchase->mode = "rising";
                $purchase->earned = 0;
                $purchase->touch();

                $purchase->save();
            }

        }

        return "done";

    }
} 