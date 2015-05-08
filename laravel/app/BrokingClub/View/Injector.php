<?php
/**
 * Project: BrokingClub | ViewInjector.php
 * Author: Simon - www.triggerdesign.de
 * Date: 02.05.2015
 * Time: 15:05
 */

namespace BrokingClub\View;

use App;
use Auth;
use Confide;
use Menu;

class Injector {

    /**
     * @var Bank
     */
    protected $bank;

    public function __construct(){
        $this->bank = App::make('Bank');
    }

    /**
     * @param array $data
     */
    public function inject($data){
        $data['bank'] = $this->bank;

        $data['mainMenu'] =  Menu::get('MainMenu');
        $data['theplayer'] = $this->thePlayer();
        $data['unreadMessagesCount'] = $this->unreadMessagesCount();

        return $data;
    }


    /**
     * @return null
     */
    public function thePlayer(){
        if(Confide::user()) return Confide::user()->player;

        return null;
    }

    public function unreadMessagesCount(){
        if(!Auth::user()) return 0;

        return Auth::user()->unreadMessagesCount();
    }

}