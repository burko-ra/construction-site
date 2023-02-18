<?php

namespace ConstructionSite\Tests\Buildings;

use PHPUnit\Framework\TestCase; 
use ConstructionSite\Buildings\Building;
use ConstructionSite\Buildings\BuildingDecorator;
use ConstructionSite\CommonAmenities\Elevator;
use ConstructionSite\Flats\FlatBuilder;
use ConstructionSite\Flats\FlatDirector;
use ConstructionSite\Levels\LevelFactory;

class BuildingDecoratorTest extends TestCase
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

    public function testPricePerSquareMeterInBuildingWithDecorator(): void
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

        $buildingWithExtra = new BuildingDecorator($this->building);
        $elevator = new Elevator();
        $elevatorPrice = $elevator->getPrice();
        $buildingWithExtra->addCommonAmenity($elevator);

        $actualPrice = $buildingWithExtra->getTotalPricePerSquareMeter();
        $expectedPrice = $price1 + $elevatorPrice / $buildingWithExtra->getArea();
        $this->assertEquals($expectedPrice, $actualPrice);
    }

}