<?php

use BrokingClub\Purchase\Resale;
use BrokingClub\View\FontAwesome;
use BrokingClub\Purchase\Bill;

class Purchase extends BaseModel {
    /**
     * @var Bill
     */
    public $bill;

    /**
     * @var Resale
     */
    public $resale;

	protected $fillable = [];

    /**
     * @var BrokingClub\Services\CalculationService
     */
    private $calculator;


    public function __construct(){
        debug($this);
        debug($this->id);
        debug($this->stock_id);

        $this->calculator = App::make('CalculationService');
        $this->bill = $this->bill();
        $this->resale = $this->resale();
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
        return $this->calculator->bill($this);
    }

    /**
     * @return Bill
     */
    public function resale(){
        return $this->calculator->resale($this);
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