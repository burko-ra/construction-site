<?php

namespace ConstructionSite\Tests\Buildings;

use PHPUnit\Framework\TestCase; 
use ConstructionSite\Buildings\Building;
use ConstructionSite\Flats\Flat;
use ConstructionSite\Flats\FlatBuilder;
use ConstructionSite\Flats\FlatDirector;
use ConstructionSite\Furnishings\BathroomTiles;
use ConstructionSite\Furnishings\Door;
use ConstructionSite\Levels\LevelFactory;
use ConstructionSite\Rooms\Balcony;
use ConstructionSite\Rooms\Bathroom;
use ConstructionSite\Rooms\Bedroom;
use ConstructionSite\Rooms\LivingRoom;
use ConstructionSite\Rooms\RoomDecorator;

use function PHPUnit\Framework\assertTrue;

class RoomDecoratorTest extends TestCase
{
    private $building;
    private $flatBuilder;
    private $flatDirector;
    private $levelFactory;

    public function setUp(): void
    {
        $this->levelFactory = new LevelFactory();
        $this->building = new Building($this->levelFactory);
        $this->flatBuilder = new FlatBuilder();
        $this->flatDirector = new FlatDirector($this->flatBuilder);
    }

    public function testGetTotalPrice(): void
    {
        $flat = new Flat();
        
        $area1 = 15;
        $area2 = 25;

        $bathroom = new Bathroom(15);
        $flat->addRoom($bathroom);
        $livingRoom = new LivingRoom(25);
        $flat->addRoom($livingRoom);

        $this->building->addLevel();
        $level1 = $this->building->getLevelById(1);
        $level1->addFlat($flat);

        $price = 1000;
        $this->building->setPricePerSquareMeter($price);

        $bathroomTilesCount = 10;
        $bathroomWithExtra = new RoomDecorator($bathroom);
        $bathroomTiles = new BathroomTiles($bathroomTilesCount);
        $bathroomTilesPricePerUnit = $bathroomTiles->getUnitPrice();
        $bathroomWithExtra->addFurnishing($bathroomTiles);

        $expectedTotalPrice1 = $area1 * $price + $bathroomTilesCount * $bathroomTilesPricePerUnit;
        $actualTotalPrice1 = $bathroomWithExtra->getTotalPrice();

        $this->assertEquals($expectedTotalPrice1, $actualTotalPrice1);

        $bathroomDoor = new Door();
        $bathroomDoorPricePerUnit = $bathroomDoor->getUnitPrice();
        $bathroomWithExtra->addFurnishing($bathroomDoor);

        $expectedTotalPrice2 = $expectedTotalPrice1 + $bathroomDoorPricePerUnit * 1;
        $actualTotalPrice2 = $bathroomWithExtra->getTotalPrice();
        $this->assertEquals($expectedTotalPrice2, $actualTotalPrice2);
    }
}
