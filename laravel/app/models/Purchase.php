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

    /**
     * @var BrokingClub\Services\CalculationService
     */
    private $calculator;

	protected $fillable = [];

    public static $rules = array(
        'amount' => 'required|integer|between:1,9999',
    );

    public function __construct(array $attributes = array()){
        $this->calculator = App::make('CalculationService');

        parent::__construct($attributes);
    }

    public function stock() {
        return $this->belongsTo('Stock');
    }

    public function player() {
        return $this->belongsTo('Player');
    }

    public function totalPaid() {
        return $this->value * $this->amount + $this->fee;
    }

    public function paidPerStock(){
        return $this->bill()->getPerStock();
    }

    /**
     * @return Bill
     */
    public function bill(){
        $this->bill = $this->calculator->bill($this);

        return $this->bill;
    }

    /**
     * @return Resale
     */
    public function resale(){
        $this->resale = $this->calculator->resale($this);

        return $this->resale;
    }

    public function price(){
        return $this->stock->price($this->amount);
    }


    public function earned(){
        return $this->resale()->grossEarned();
    }

    public function sellOffer(){
        return $this->totalPaid() + $this->earned();
    }


    /**
     * @return string
     */
    public function earnedIcon(){
        return FontAwesome::changeRateIcon($this->earnedMode());
    }

    public function earnedMode(){
        return $this->resale()->earnedMode();
    }




}