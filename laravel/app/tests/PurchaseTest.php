<?php
/**
 * Project: BrokingClub | PurachseTest.php
 * Author: Simon - www.triggerdesign.de
 * Date: 29.04.2015
 * Time: 11:45
 */

use Laracasts\TestDummy\Factory as LFaker;

class PurchaseTest extends TestCase{
    /**
     * @test
     */
    public function testAmountIsPositive(){
        $fakePurchase = $this->purchaseMock();
        $fakePurchase->amount = -5;

        $this->assertModelHasError($fakePurchase, 'amount');
    }

    /**
     * @test
     */
    public function testNotExistingStock(){
        $fakePurchase = $this->purchaseMock();
        $fakePurchase->stock_id = 129389162381;

        $this->assertModelHasError($fakePurchase, 'stock_id');
    }

    /**
     * @test
     */
    public function testFeeIsPositive(){
        $fakePurchase = $this->purchaseMock();

        $this->assertGreaterThan(0, $fakePurchase->bill()->getFee(), 'stock_id');
    }

    public function testBillIsCorrect(){
        $fakePurchase = $this->purchaseMock();

        $bill = new \BrokingClub\Purchase\Bill($fakePurchase, $fakePurchase->stock);

        $bank = new \BrokingClub\Purchase\Bank();
        $expectedFee = $fakePurchase->amount * $fakePurchase->stock->newestValue() * $bank->feeRate();
        $expectedTotal = floor(($fakePurchase->amount * $fakePurchase->stock->newestValue()) + $expectedFee);

        $this->assertEquals($expectedFee, $bill->getFee(), 'Expected fee');
        $this->assertEquals($expectedTotal, floor($bill->getTotal()), 'Expected total');
    }





    /**
     * @return Purchase
     */
    public function purchaseMock(){
        $purchase = LFaker::build('Purchase');
        $stock = \Stock::findOrFail($purchase->stock_id);

        $purchase->fillPurchase($stock);
        return $purchase;
    }


} 