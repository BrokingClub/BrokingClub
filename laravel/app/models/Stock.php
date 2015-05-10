<?php

use BrokingClub\Cache\CacheManager;
use BrokingClub\View\FontAwesome;

class Stock extends BaseModel
{
    protected $fillable = [];

    /**
     * @var BrokingClub\Cache\StockValuesCache
     */
    protected $newestValuesCache;

    /**
     * @var BrokingClub\Statistics\ArrayGenerator
     */
    protected $arrayGenerator;

    /**
     * @var BrokingClub\Statistics\MarketLogic
     */
    protected $marketLogic;


    public function __construct($attributes = array())
    {
        parent::__construct($attributes);

        $this->newestValuesCache = CacheManager::add('newestStockValues', 'StockValuesCache');
        $this->arrayGenerator = App::make('BrokingClub\\Statistics\\ArrayGenerator');
        $this->marketLogic = App::make('BrokingClub\\Statistics\\MarketLogic');
    }

    public function values()
    {
        return $this->hasMany('StockValue')->orderBy('created_at', 'DESC');
    }

    public function newestValueObject()
    {
        return $this->newestValues()->first();
    }

    public function newestValue()
    {
        return $this->newestValueObject()->value;
    }

    public function newestValues($limit = 20)
    {
        return $this->newestValuesCache->newest($this, $limit);
    }

    public function newestValuesArray($limit = 3000, $step = 250, $valuesOnly = true)
    {
        $newestValues = $this->newestValues($limit);
        $attribute = ($valuesOnly)? "value" : false;

        return $this->arrayGenerator->steppedArray($newestValues, $step, $attribute);
    }

    public function newestVariationsArray($limit = 3000, $step = 250)
    {
        $newestValues = $this->newestValuesArray($limit, $step);
        return $this->arrayGenerator->variationArray($newestValues);
    }


    public function price($amount)
    {
        return $this->newestValueObject()->value * $amount;
    }

    public function changeRate($range = 20)
    {
        $newestValues = $this->newestValues($range);
        return $this->marketLogic->changeRate($newestValues);
    }

    public function changeRatePercent($asString = false, $range = 20)
    {
        $newestValues = $this->newestValues($range);
        return $this->marketLogic->changeRatePercent($newestValues, $asString);
    }

    public function changeRateIcon()
    {
        return FontAwesome::changeRateIcon($this->changeRateMode());
    }

    public function changeRateMode($range = 20)
    {

        $newestValues = $this->newestValues($range);
        return $this->marketLogic->changeRateMode($newestValues);
    }

    public function category()
    {
        return $this->belongsTo('StockCategory', 'stock_category_id', 'id');
    }

}