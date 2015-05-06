<?php
/**
 * Project: BrokingClub | PurachseTest.php
 * Author: Simon - www.triggerdesign.de
 * Date: 29.04.2015
 * Time: 11:45
 */

use BrokingClub\Repositories\StockRepository;
use Laracasts\TestDummy\Factory as LFaker;

class StockRepositoryTest extends TestCase{
    /**
     * @var StockRepository
     */
    private $repo;

    protected function _before()
    {
        $this->repo = new StockRepository();
    }

    /**
     * @test
     */
    public function testFindsOne(){
        $this->_before();

        $randomId = \Stock::orderByRaw("RAND()")->first()->id;

        $found = $this->repo->findById($randomId);

        $this->assertNotEmpty($found, "Real stock found");

    }

    /**
     * @test
     */
    public function testFailsOnUnkown(){
        $this->_before();

        $id = 12192837182371923;

        $found = $this->repo->findById($id, false);

        $this->assertNull($found, "Unknown stock not found");

    }

    /**
     * @test
     */
    public function testFindsByPurchase(){
        $this->_before();

        $randomPurchase = \Purchase::orderByRaw("RAND()")->first();

        $found = $this->repo->findByPurchase($randomPurchase);

        $this->assertNotNull($found);

    }
} 