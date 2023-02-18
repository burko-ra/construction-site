<?php

namespace ConstructionSite\Tests\Buildings;

use PHPUnit\Framework\TestCase; 
use ConstructionSite\Buildings\Building;
use ConstructionSite\Flats\FlatBuilder;
use ConstructionSite\Flats\FlatDirector;
use ConstructionSite\Levels\LevelFactory;

class BuildingTest extends TestCase
{
    private $building;
    private $flatBuilder;
    private $flatDirector;

    public function setUp(): void
    {
        $levelFactory = new LevelFactory();
        $this->building = new Building($levelFactory);
        $this->flatBuilder = new FlatBuilder();
        $this->flatDirector = new FlatDirector($this->flatBuilder);
    }

    public function testGetFlatCount(): void
    {
        $building = $this->building;
        $this->assertEquals(0, $building->getFlatCount());

        $building->addLevel();
        $level1 = $building->getLevelById(1);
        $flat1 = $this->flatDirector->buildOneRoomFlat();
        $flat2 = $this->flatDirector->buildTwoRoomFlat();
        $level1->addFlat($flat1);
        $level1->addFlat($flat2);
        $this->assertEquals(2, $building->getFlatCount());

        $building->addLevel();
        $flat3 = $this->flatDirector->buildOneRoomFlat();
        $level2 = $building->getLevelById(2);
        $level2->addFlat($flat3);
        $this->assertEquals(3, $building->getFlatCount());

        $this->assertEquals(2, $building->getFlatCount(1));
    }

    public function testSetPricePerSquareMeter(): void
    {
        $building = $this->building;
        $this->assertEquals(0, $building->getFlatCount());

        $building->addLevel();
        $level1 = $building->getLevelById(1);
        $flat1 = $this->flatDirector->buildOneRoomFlat();
        $level1->addFlat($flat1);

        $price1 = 1000;
        $building->setPricePerSquareMeter($price1);
        $area = $flat1->getArea();
        $totalPrice1 = $flat1->getTotalPrice();
        $this->assertEquals($price1, $totalPrice1 / $area);

        $price2 = 1500;
        $building->setPricePerSquareMeter($price2);
        $totalPrice2 = $flat1->getTotalPrice();
        $this->assertEquals($price2, $totalPrice2 / $area);
    }

}