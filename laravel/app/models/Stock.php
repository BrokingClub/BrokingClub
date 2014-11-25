<?php

class Stock extends BaseModel
{
	protected $fillable = [];

    protected $newestValues = array();

    public function values(){
        return $this->hasMany('StockValue')->orderBy('created_at', 'DESC');
    }

    public function newestValue(){
        if(!empty($this->newestValues))
            return $this->newestValues->first();

        return $this->newestValues()->first();
    }

    public function newestValues($limit = 20){
        if(count($this->newestValues) == $limit)
            return $this->newestValues;

        $newestValues = StockValue::where('stock_id', $this->id)->orderby('created_at', 'desc')
            ->limit($limit)->get();

        $this->newestValues = $newestValues;

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