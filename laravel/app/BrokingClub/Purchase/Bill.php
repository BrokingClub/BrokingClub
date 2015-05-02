<?php
/**
 * Project: BrokingClub | Bill.php
 * Author: Simon - www.triggerdesign.de
 * Date: 29.04.2015
 * Time: 15:01
 */

namespace BrokingClub\Purchase;


use \Purchase;
use \Stock;

class Bill
{
    /**
     * @var Bank
     */
    private $bank;

    private $fee;

    private $price;

    private $perStock;

    private $total;


    /**
     * @var Purchase
     */
    public $purchase;

    /**
     * @var float
     */
    private $newestValue;

    /**
     * @var Stock
     */
    public $stock;

    /**
     * @param Purchase $purchase
     * @param Stock $stock
     */
    public function __construct($purchase, $stock)
    {
        $this->purchase = $purchase;
        $this->stock = $stock;

        $this->newestValue = $this->stock->newestValue();

        $this->bank = \App::make('Bank');

        $this->calculate();
    }

    /**
     * @param Purchase $purchase
     * @param Stock $stock
     */
    public function calculate()
    {
        $this->fee = $this->fee();
        $this->price = $this->price();
        $this->total = $this->total();
        $this->perStock = $this->perStock();
    }

    private function fee()
    {
        return
            ($this->newestValue * $this->stock->amount) * $this->bank->feeBase();
    }

    private function price()
    {
        return ($this->newestValue * $this->stock->amount);
    }

    private function total()
    {
        return intval($this->price + $this->fee);
    }

    private function perStock()
    {
        return $this->total / $this->amount;
    }



    public function toArray()
    {
        return [
            "fee" => $this->fee,
            "price" => $this->price,
            "perStock" => $this->perStock,
            "total" => $this->total
        ];
    }

    /**
     * @return mixed
     */
    public function getFee()
    {
        return $this->fee;
    }

    /**
     * @return mixed
     */
    public function getPerStock()
    {
        return $this->perStock;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return mixed
     */
    public function getTotal()
    {
        return $this->total;
    }


}