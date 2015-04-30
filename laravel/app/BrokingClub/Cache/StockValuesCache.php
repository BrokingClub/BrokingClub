<?php
/**
 * Project: BrokingClub | StockValuesCache.php
 * Author: Simon - www.triggerdesign.de
 * Date: 30.04.2015
 * Time: 18:14
 */

namespace BrokingClub\Cache;


use App;

class StockValuesCache extends ObjectCache
{

    /**
     * @var \BrokingClub\Repositories\StockValueRepository
     */
    protected $stockValueRepository;

    public function __construct()
    {
        $this->stockValueRepository = App::make('BrokingClub\Repositories\StockValueRepository');

    }

    public function newest($stock, $limit)
    {
        $id = $this->generateId($stock);

        $found = $this->get($id);

        /**
         * Get a part of the newest values if a larger collection
         * is already in the memory
         */
        if($found && $found->count() > $limit){
            return $found->take($limit);
        }

        /**
         * Remove the small collection if we need a larger one
         */
        if($found && $found->count() < $limit){
            $this->remove($id);
        }

        $newest = $this->getOrStore(
            $id,
            function () use ($stock, $limit) {
                return $this->stockValueRepository->newest($stock, $limit);
            }
        );

        return $newest;

    }

    public function generateId($stock){
        return $stock->id;
    }


}