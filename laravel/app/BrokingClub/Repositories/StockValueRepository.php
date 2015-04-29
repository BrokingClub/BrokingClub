<?php
/**
 * Project: BrokingClub | StockValueRepository.php
 * Author: Simon - www.triggerdesign.de
 * Date: 29.04.2015
 * Time: 15:17
 */

namespace BrokingClub\Repositories;


use StockValue;

class StockValueRepository
{

    public function newest($stock, $limit)
    {
        return StockValue::where('stock_id', $stock->id)
            ->orderby('created_at', 'desc')
            ->limit($limit)->get();
    }

} 