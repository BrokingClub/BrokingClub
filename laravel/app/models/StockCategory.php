<?php

class StockCategory extends BaseModel {

	protected $fillable = ['name'];
    protected $table = "stock_categories";

    public static $rules = array(
        'name'  => 'required'
    );

}