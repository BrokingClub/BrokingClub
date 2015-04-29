<?php
namespace BrokingClub\Repositories;
/**
 * Project: BrokingClub | PurchaseRepository.php
 * Author: Simon - www.triggerdesign.de
 * Date: 29.04.2015
 * Time: 13:40
 */

class PurchaseRepository {
    public function findById($id){
        return Purchase::find($id);
    }

}