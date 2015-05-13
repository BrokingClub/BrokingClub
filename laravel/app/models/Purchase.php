<?php

use BrokingClub\Purchase\Resale;
use BrokingClub\Services\CalculationService;
use BrokingClub\View\FontAwesome;
use BrokingClub\Purchase\Bill;

class Purchase extends BaseModel
{
    /**
     * @var Bill
     */
    public $bill;

    /**
     * @var Resale
     */
    public $resale;

    /**
     * @var CalculationService
     */
    private $calculator;

    protected $fillable = [];

    public static $rules = array(
        'stock_id' => 'required|exists:stocks,id',
        'amount' => 'required|integer|between:1,9999',
        'fee' => 'required|numeric|min:0',
        'value' => 'required|numeric|min:0',
    );

    public function __construct(array $attributes = array())
    {

        $this->calculator = App::make('CalculationService');

        parent::__construct($attributes);
    }

    /**
     * Calculate the bill and the offer if values from the database are filled in
     */
    public function filled()
    {

        $this->bill();
        $this->resale();
    }


    public function stock()
    {
        return $this->belongsTo('Stock');
    }

    public function player()
    {
        return $this->belongsTo('Player');
    }

    public function paidPerStock()
    {
        return $this->bill()->getPerStock();
    }

    /**
     * @param bool $recalculate
     * @return Bill
     */
    public function bill($recalculate = false)
    {
        if (!$this->bill || $recalculate)
            $this->bill = $this->calculator->bill($this);

        return $this->bill;
    }

    /**
     * @param bool $recalculate
     * @return Resale
     */
    public function resale($recalculate = false)
    {
        if (!$this->resale || $recalculate)
            $this->resale = $this->calculator->resale($this);

        return $this->resale;
    }

    public function price()
    {
        return $this->stock->price($this->amount);
    }


    public function earned()
    {
        return $this->resale()->grossEarned();
    }

    public function sellOffer()
    {
        return $this->resale()->offer();
    }


    /**
     * @return string
     */
    public function earnedIcon()
    {
        return FontAwesome::changeRateIcon($this->earnedMode());
    }

    public function earnedMode()
    {
        return $this->resale()->earnedMode();
    }

    public function total()
    {
        return $this->bill()->getTotal();
    }

    /**
     * @param Stock $stock
     * @param int $amount
     */
    public function fillPurchase($stock, $amount = 0)
    {
        if ($this->stock_id != $stock->id) {
            $this->stock_id = $stock->id;
        }

        $this->amount = $amount;

        $this->bill(true);
        $this->resale(true);
    }

    public function setAmountAttribute($amount)
    {
        if ($amount == 0) {
            $amount = $this->amount;
        }


        $this->attributes['amount'] = $amount;
        $this->attributes['value'] = $this->stock->newestValue();
        $this->attributes['fee'] = $this->bill(true)->getFee();
    }


}