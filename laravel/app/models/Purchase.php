<?php

use BrokingClub\View\FontAwesome;
use BrokingClub\Purchase\Bill;

class Purchase extends BaseModel {
    /**
     * @var Bill
     */
    protected $bill;

	protected $fillable = [];

    /**
     * @var BrokingClub\Services\CalculationService
     */
    private $calculator;


    public function __construct(){
        $this->calculator = App::make('CalculationService');
    }

    public static $rules = array(
        'amount' => 'required|integer|between:1,9999',
    );



    public function stock() {
        return $this->belongsTo('Stock');
    }

    public function player() {
        return $this->belongsTo('Player');
    }

    public function totalPaid() {
        $amount = $this->amount;
        $total = $this->value * $amount + $this->fee;
        return $total;
    }

    public function paidPerStock(){
        $feePerStock = $this->fee / $this->amount;
        return $this->value + $feePerStock;
    }

    /**
     * @return Bill
     */
    public function bill(){
        return $this->calculator->bill($this->stock_id);
    }

    public function price(){
        return $this->stock->price($this->amount);
    }

    public function newestValue(){
        return $this->stock->newestValue();
    }

    public function changeRatio(){
        $oldValue = $this->value;
        $newValue = $this->newestValue();

        $changeRatio = $newValue / $oldValue;
        return $changeRatio;
    }


    public function earned(){
        $oldValue = $this->value;
        $newValue = $this->newestValue();

        $nettoEarned = ($newValue - $oldValue) * (static::$globalLeverage * ($this->leverage/100))  * $this->amount;


        if($this->mode == "falling"){
            $nettoEarned *= -1;
        }

        $bruttoEarned = $nettoEarned - $this->fee;

        return $bruttoEarned;
    }

    public function sellOffer(){
        return $this->totalPaid() + $this->earned();
    }

    public static function feeRate(){
        return static::$feeBase;
    }

    /**
     * @return string
     */
    public function earnedIcon(){
        return FontAwesome::changeRateIcon($this->earnedMode());
    }

    public function earnedMode(){
        $earned = $this->earned();

        if($earned == 0) return "neutral";

        return ($earned > 0)? "rising" : "falling";
    }




}