<?php

class StockValue extends BaseModel {
	protected $fillable = [];
    protected $table = "stock_values";

    public function stock(){
        return $this->belongsTo('Stock');
    }
}