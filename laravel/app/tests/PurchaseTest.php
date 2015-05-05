<?php
/**
 * Project: BrokingClub | PurachseTest.php
 * Author: Simon - www.triggerdesign.de
 * Date: 29.04.2015
 * Time: 11:45
 */

use Laracasts\TestDummy\Factory as LFaker;

class PurchaseTest extends TestCase{
    public function testPaidIsPositive(){
        $purchase = new Purchase();


        $fakePurchase = $this->randomPurchase();
    }

    /**
     * @return Purchase
     */
    public function randomPurchase(){
        return LFaker::build('Purchase');
    }


} 