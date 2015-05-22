<?php
/**
 * Project: BrokingClub | ArrayGeneratorTest.php
 * Author: Simon - www.triggerdesign.de
 * Date: 22.05.2015
 * Time: 10:49
 */

use Laracasts\TestDummy\Factory as LFaker;

class MarketLogicTest extends TestCase{

    private static $randomStockId;

    private function randomStockId(){
        if(static::$randomStockId) return static::$randomStockId;

        static::$randomStockId = Stock::orderBy(DB::raw('RAND()'))->first()->id;

        return static::$randomStockId;
    }

    public function testChangeRate(){
        $marketLogic = new \BrokingClub\Statistics\MarketLogic();

        $stockValuesFalling = new \Illuminate\Support\Collection([
            $this->mockStockValue(10),  //newest Value
            $this->mockStockValue(50),
            $this->mockStockValue(80),
            $this->mockStockValue(100)  //oldest Value
        ]);

        $stockValuesRising = $stockValuesFalling->reverse();

        $fallingChangeRate = $marketLogic->changeRate($stockValuesFalling);
        $risingChangeRate = $marketLogic->changeRate($stockValuesRising);

        $fallingChangeRatePercent = $marketLogic->changeRatePercent($stockValuesFalling);
        $risingChangeRatePercent = $marketLogic->changeRatePercent($stockValuesRising);

        $fallingChangeRateMode = $marketLogic->changeRateMode($stockValuesFalling);
        $risingChangeRateMode = $marketLogic->changeRateMode($stockValuesRising);

        var_dump($fallingChangeRate);
        var_dump($risingChangeRate);
        var_dump($fallingChangeRatePercent);
        var_dump($risingChangeRatePercent);
        var_dump($fallingChangeRateMode);
        var_dump($risingChangeRateMode);


        $this->assertLessThan(1, $fallingChangeRate, '$fallingChangeRate ');
        $this->assertGreaterThan(1, $risingChangeRate, '$risingChangeRate');

        $this->assertLessThan(0, $fallingChangeRatePercent, '$fallingChangeRatePercent ');
        $this->assertGreaterThan(0, $risingChangeRatePercent, '$risingChangeRatePercent');

        $this->assertEquals('falling', $fallingChangeRateMode, '$fallingChangeRateMode');
        $this->assertEquals('rising', $risingChangeRateMode, '$risingChangeRateMode');

    }

    private function mockStockValue($value){
        $stockValue = new StockValue();
        $stockValue->value = $value;
        $stockValue->stock_id = $this->randomStockId();

        return $stockValue;
    }

} 