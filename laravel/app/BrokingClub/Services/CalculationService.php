<?php
namespace BrokingClub\Services;
use BrokingClub\Purchase\Bill;
use BrokingClub\Repositories\StockRepository;

/**
 * Project: BrokingClub | CalculationService.php
 * Author: Simon - www.triggerdesign.de
 * Date: 29.04.2015
 * Time: 13:51
 */


class CalculationService {
    /**
     * @var StockRepository
     */
    private $stockRepository;


    /**
     * @param $stockRepository
     */
    public function __construct(){
        $this->stockRepository = \App::make('StockRepository');
    }

    /**
     * @param Purchase $purchase
     * @return array
     */
    public function bill($purchase){
        $stock = $this->stockRepository->findByPurchase($purchase);
        $bill = new Bill($purchase, $stock);

        return $bill;
    }

    public function fee(){

    }



} 