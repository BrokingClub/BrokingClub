<?php

class Stock extends BaseModel
{
	protected $fillable = [];

    public function values(){
        return $this->hasMany('StockValue')->orderBy('created_at', 'DESC');
    }

    public function newestValue(){
        return $this->newestValues(1)->first();
    }

    public function newestValues($limit = 5){
        return StockValue::where('stock_id', $this->id)->orderby('created_at', 'desc')
            ->limit($limit)->get();
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