<?php
/**
 * Project: BrokingClub | PurachseTest.php
 * Author: Simon - www.triggerdesign.de
 * Date: 29.04.2015
 * Time: 11:45
 */

use Laracasts\TestDummy\Factory as LFaker;

class PurchaseTest extends TestCase{
    public function testAmountIsPositive(){
        $fakePurchase = $this->randomPurchase();
        $fakePurchase->amount = -5;

        $this->assertModelHasError($fakePurchase, 'amount');
    }

    public function testNotExistingStock(){
        $fakePurchase = $this->randomPurchase();
        $fakePurchase->stock_id = 129389162381;

        $this->assertModelHasError($fakePurchase, 'stock_id');
    }

    public function testFeeIsPositive(){
        $fakePurchase = $this->randomPurchase();

        $this->assertGreaterThan(0, $fakePurchase->bill()->getFee(), 'stock_id');
    }

    /**
     * @return Purchase
     */
    public function randomPurchase(){
        $purchase = LFaker::build('Purchase');
        $stock = \Stock::findOrFail($purchase->stock_id);

        $purchase->fillPurchase($stock);
        return $purchase;
    }


} 