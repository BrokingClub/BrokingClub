<?php
/**
 * Project: BrokingClub | PlayerTest.php
 * Author: Simon - www.triggerdesign.de
 * Date: 10.05.2015
 * Time: 17:16
 */

use Laracasts\TestDummy\Factory as LFaker;

class PlayerTest extends TestCase{
    /**
     * @test
     */
    public function testCharging(){
        $player = $this->playerMock();

        $balanceBefore = $player->balance;

        $charge = rand(-1000,1000);
        $result = $player->charge($charge);

        $balanceAfter = $player->balance;

        $this->assertEquals($balanceBefore - $charge, $balanceAfter);
    }

    /**
     * @test
     */
    public function testChargeToHigh() {
        $player = $this->playerMock();

        $balanceBefore = $player->balance;

        $charge = $player->balance + 1;
        $result = $player->charge($charge);

        $balanceAfter = $player->balance;

        $this->assertEquals($balanceBefore, $balanceAfter);
        $this->assertFalse($result);
    }

        /**
     * @return Player
     */
    public function playerMock(){
        $purchase = LFaker::build('Player');
        return $purchase;
    }

} 