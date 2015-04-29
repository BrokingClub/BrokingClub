<?php
namespace BrokingClub\Repository;
/**
 * Project: BrokingClub | PurchaseRepository.php
 * Author: Simon - www.triggerdesign.de
 * Date: 29.04.2015
 * Time: 13:40
 */

class StockRepository {
    public function findById($id, $orFail = true){
        if(!$orFail)
            return \Stock::find($id);

        return \Stock::findOrFail($id);
    }

    public function findByPurchase($purchase){
        return $this->findById($purchase->stock_id);
    }

}