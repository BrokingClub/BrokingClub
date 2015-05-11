<?php
/**
 * Project: BrokingClub | Notifier.php
 * Author: Simon - www.triggerdesign.de
 * Date: 11.05.2015
 * Time: 16:55
 */

namespace BrokingClub\RolePlay;


class Notifier {

    private $dispatcher;




    /**
     * @param $oldLevel
     * @param $newLevel
     */
    public function onLevelUp($player, $oldLevel, $newLevel){
        $message = 'Your level increased from ' . $oldLevel . ' to ' . $newLevel;

        static::flash('levelUp', 'Congratulations!', $message);
    }

    /**
     * @param $oldLevel
     * @param $newLevel
     */
    public function onExpAdded($player, $amount, $reason){
        $message = 'You have just gained ' .  $amount . ' Experience Points. Reason: ' . $reason;

        static::flash('expAdded', 'EXP gained', $message);
    }


    /**
     * @param $key
     * @param string $title
     * @param string $message
     */
    private static function flash($key, $title = "", $message = ""){
        \Session::flash('rolePlay.' . $key, ['title' => $title, 'message' => $message]);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @return array
     */
    public function subscribe($dispatcher){

        $this->dispatcher = $dispatcher;

        $this->listenTo('roleplay.exp.added', 'onExpAdded');
        $this->listenTo('roleplay.level.up', 'onLevelUp');


    }

    private function listenTo($event, $action){
        $this->dispatcher->listen($event, 'BrokingClub\RolePlay\Notifier@' . $action);
    }



} 