<?php

class StockCategory extends BaseModel {

	protected $fillable = ['name'];
    protected $table = "stock_categories";



    public function stocks()
    {
        return $this->hasMany('Stock');
    }

    public static $rules = array(
        'name'  => 'required'
    );

}