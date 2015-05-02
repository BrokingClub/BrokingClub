<?php
/**
 * Project: BrokingClub | Bank.php
 * Author: Simon - www.triggerdesign.de
 * Date: 02.05.2015
 * Time: 14:55
 */

namespace BrokingClub\Purchase;


use Config;

class Bank {
    public function feeRate(){
        return $this->feeBase();
    }

    public function feeBase(){
        return Config::get('brokingclub.feeBase');
    }

    public function globalLeverage(){
        return Config::get('brokingclub.globalLeverage');
    }

} 