<?php

class Stock extends BaseModel
{
	protected $fillable = [];

    protected $newestValues = array();

    public function values(){
        return $this->hasMany('StockValue')->orderBy('created_at', 'DESC');
    }

    public function newestValueObject(){
        if(!empty($this->newestValues))
            return $this->newestValues->first();

        return $this->newestValues()->first();
    }

    public function newestValue(){
       return $this->newestValueObject()->value;
    }

    public function newestValues($limit = 20){
        if(count($this->newestValues) == $limit)
            return $this->newestValues;

        $newestValues = StockValue::where('stock_id', $this->id)->orderby('created_at', 'desc')
            ->limit($limit)->get();

        $this->newestValues = $newestValues;

        return $newestValues;

    }

    public function price($amount) {
        return $this->newestValueObject()->value * $amount;
    }

    public function changeRate(){
        $range = 20;
        $newestValues = $this->newestValues($range);
        $newestValueNum = $newestValues->first()->value;
        $oldestValueNum = $newestValues->last()->value;

        $change = $newestValueNum / $oldestValueNum;

        return $change;
    }

    public function changeRatePercent($asString = false){
        $changeRate = $this->changeRate();

        $changeRatePercent = round(($changeRate - 1)*100,3);

        if(!$asString)
            return $changeRatePercent;
        else
            return ($changeRatePercent > 0)? '+' . $changeRatePercent . '%' : $changeRatePercent . "%";
    }

    public function changeRateMode(){
        $percent = $this->changeRatePercent();

        if($percent == 0) return "neurtral";

        return ($percent > 0)? "rising" : "falling";
    }

}