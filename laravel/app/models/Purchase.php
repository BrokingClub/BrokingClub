<?php

class Purchase extends BaseModel {
	protected $fillable = [];

    protected static $feeBase = 0.1;
    protected static $globalLeverage = 2;

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

    public function calculateBill(){
        $stock = Stock::findOrFail($this->stock_id);

        $fee =      $this->calculateFee($stock);
        $price =    $this->calculatePrice($stock);
        $total =    intval($price + $fee);
        $perStock = $total / $this->amount;

        $bill = [
            "fee" => $fee,
            "price" => $price,
            "perStock" => $perStock,
            "total" => $total
        ];

        $bill = array_map(function($double){ return round($double, 4); }, $bill);

        return $bill;
    }

    public function calculatePrice($stock){
        $newestValue = $stock->newestValue();
        return ($newestValue * $this->amount);
    }

    public function calculateFee($stock){
        $user = Auth::user();

        //TODO: More complex fee calculation logic here

        $newestValue = $stock->newestValue();

        return ($newestValue * $this->amount)* static::$feeBase;
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

        $nettoEarned = ($newValue - $oldValue) * static::$globalLeverage  * $this->amount;


        if($this->mode == "falling"){
            $nettoEarned *= -1;
        }

        $bruttoEarned = $nettoEarned - $this->fee;

        return $bruttoEarned;
    }

    public function sellOffer(){
        return $this->value * $this->amount + $this->earned();
    }
}