<?php
namespace BrokingClub\Repositories;
use BrokingClub\Cache\RepositoryCache;

/**
 * Project: BrokingClub | PurchaseRepository.php
 * Author: Simon - www.triggerdesign.de
 * Date: 29.04.2015
 * Time: 13:40
 */

class StockRepository extends RepositoryCache{
    protected $class = "Stock";

    public function findByPurchase($purchase){
        return $this->findById($purchase->stock_id);
    }

}