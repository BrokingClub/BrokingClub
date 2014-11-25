<?php

class Stock extends BaseModel
{
	protected $fillable = [];

    protected $newestValues = array();

    public function values(){
        return $this->hasMany('StockValue')->orderBy('created_at', 'DESC');
    }

    public function newestValue(){
        if(!is_null($this->newestValue))  return $this->newestValue;

        return $this->newestValues(1)->first();
    }

    public function newestValues($limit = 5){
        $newestValues = StockValue::where('stock_id', $this->id)->orderby('created_at', 'desc')
            ->limit($limit)->get();

        $this->newestValue = $newestValues->first();

        return $newestValues;

    }

    public function changeRate(){
        $range = 20;
        $newestValues = $this->newestValues($range);
        $newestValueNum = $newestValues->first()->value;

        $newestSum = 0;
        foreach($newestValues as $newestValue){
            $newestSum += $newestValue->value;
        }

        $average = $newestSum / $range;
        $change = $newestValueNum / $average;

        return $change;
    }


}