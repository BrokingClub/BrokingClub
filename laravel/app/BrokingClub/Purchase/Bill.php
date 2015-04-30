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
    private $fee;

    private $price;

    private $perStock;

    private $total;

    /**
     * @var Purchase
     */
    public $purchase;

    /**
     * @var Stock
     */
    public $stock;

    public function __construct($purchase, $stock)
    {

    }

    /**
     * @param Purchase $purchase
     * @param Stock $stock
     */
    public function calculate($purchase, $stock)
    {
        $this->fee = $purchase->calculateFee($stock);
        $this->price = $purchase->calculatePrice($stock);
        $this->total = intval($this->price + $this->fee);
        $this->perStock = $this->total / $this->amount;
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


} 