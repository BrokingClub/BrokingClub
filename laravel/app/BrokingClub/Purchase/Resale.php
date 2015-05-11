<?php
/**
 * Project: BrokingClub | Resale.php
 * Author: Simon - www.triggerdesign.de
 * Date: 02.05.2015
 * Time: 15:19
 */

namespace BrokingClub\Purchase;


use Purchase;
use Stock;

class Resale
{

    /**
     * @var Purchase
     */
    public $purchase;

    /**
     * @var float
     */
    private $newestValue;

    /**
     * @var float
     */
    private $purchaseValue;

    /**
     * @var int leverage in percent (100,200,500)
     */
    private $leverage;

    /**
     * @var Stock
     */
    public $stock;

    /**
     * @var Bank
     */
    private $bank;


    /**
     * @param Purchase $purchase
     * @param Stock $stock
     */
    public function __construct($purchase, $stock)
    {
        $this->purchase = $purchase;
        $this->stock = $stock;

        $this->newestValue = $this->stock->newestValue();
        $this->purchaseValue = $this->purchase->value;
        $this->leverage = $this->purchase->leverage;

        $this->bank = \App::make('Bank');


    }


    public function nettEarned(){
        $valueDifference = $this->newestValue - $this->purchaseValue;

        $earned = $valueDifference
            * ($this->bank->globalLeverage() * ($this->leverageFactor()))
            * $this->purchase->amount;

        if($this->purchase->mode == "falling"){
            $earned *= -1;
        }

        return $earned;
    }

    public function grossEarned(){
        if($this->purchase->earned != 0) return $this->purchase->earned;

        $nettEarned = $this->nettEarned();

        $grossEarned = $nettEarned - $this->purchase->fee;

        return $grossEarned;
    }

    public function earnedString(){
        $string = "";

        $grossEarned = floor($this->grossEarned());

        if($grossEarned > 0)
            $string = "You have earned ". $grossEarned . "$ with this sale, f*** yeah.";
        else
            $string = "Oh no, you lost ". $grossEarned . "$ with this sale.";


        return $string;
    }

    public function leverageFactor(){
        return $this->leverage/100;
    }

    public function offer(){
        return $this->purchase->total() + $this->grossEarned();
    }

    public function earnedMode(){
        $earned = $this->grossEarned();

        if($earned == 0) return "neutral";

        return ($earned > 0)? "rising" : "falling";
    }
} 