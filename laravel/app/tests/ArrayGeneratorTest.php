<?php
/**
 * Project: BrokingClub | ArrayGeneratorTest.php
 * Author: Simon - www.triggerdesign.de
 * Date: 22.05.2015
 * Time: 10:49
 */

use Laracasts\TestDummy\Factory as LFaker;

class ArrayGeneratorTest extends TestCase{

    public function testVariationArray(){
        $randomFloats = [];
        for($x = 0; $x != 100; $x++){
            $randomFloats[] = rand(-50,500);
        }

        $arrayGenerator = new \BrokingClub\Statistics\ArrayGenerator();
        $variationsArray = $arrayGenerator->variationArray($randomFloats);

        $max = max($variationsArray);
        $min = min($variationsArray);

        $this->assertGreaterThanOrEqual(0, $min, 'Variation is bigger than 0%');
        $this->assertGreaterThanOrEqual(100, $max, 'Variation is smaller than 100%');
        $this->assertEquals(100, count($variationsArray));
    }

} 