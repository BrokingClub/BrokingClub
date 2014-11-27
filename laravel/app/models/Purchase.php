<?php

class Purchase extends BaseModel {
	protected $fillable = [];

    protected static $feeBase = 0.01;

    public function stock() {
        return $this->belongsTo('Stock');
    }

    public function total() {
        $paid = $this->paid;
        $amount = $this->amount;
        $total = $paid*$amount;
        return $total;
    }

    public function calculateBill(){
        $stock = Stock::findOrFail($this->stock_id);

        $fee =      $this->calculateFee($stock);
        $price =    $this->calculatePrice($stock);
        $total =    intval($price + $fee);
        $perStock = $price / $this->amount;

        $bill = [
            "calculateFee" => $fee,
            "calculatePrice" => $price,
            "perStock" => $perStock,
            "total" => $total
        ];

        $bill = array_map(function($double){ return round($double, 2); }, $bill);

        return $bill;
    }

    public function calculatePrice($stock){
        $newestValue = $stock->newestValue()->value;
        return ($newestValue * $this->amount);
    }

    public function calculateFee($stock){
        $user = Auth::user();

        //TODO: More complex fee calculation logic here

        $newestValue = $stock->newestValue()->value;

        return ($newestValue * $this->amount)* static::$feeBase;
    }

    public function price(){

        return $this->stock->price($this->amount);
    }
}