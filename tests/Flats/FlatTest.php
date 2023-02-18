<?php

namespace ConstructionSite\Tests\Buildings;

use PHPUnit\Framework\TestCase; 
use ConstructionSite\Buildings\Building;
use ConstructionSite\Flats\Flat;
use ConstructionSite\Flats\FlatBuilder;
use ConstructionSite\Flats\FlatDirector;
use ConstructionSite\Levels\LevelFactory;
use ConstructionSite\Rooms\Balcony;
use ConstructionSite\Rooms\Bedroom;
use ConstructionSite\Rooms\LivingRoom;

use function PHPUnit\Framework\assertTrue;

class FlatTest extends TestCase
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

    public function testGetMainRoomCount(): void
    {
        $flat = new Flat();
        $this->assertEquals(0, $flat->getMainRoomCount());

        $bedroom = new Bedroom(15);
        $flat->addRoom($bedroom);
        $this->assertEquals(1, $flat->getMainRoomCount());

        $livingRoom = new LivingRoom(25);
        $flat->addRoom($livingRoom);
        $this->assertEquals(2, $flat->getMainRoomCount());

        $balcony = new Balcony(5);
        $flat->addRoom($balcony);
        $this->assertEquals(2, $flat->getMainRoomCount());
    }

    public function testGetArea(): void
    {
        $flat = new Flat();
        $this->assertEquals(0, $flat->getArea());

        $area1 = 15;
        $area2 = 25;
        $area3 = 5;

        $bedroom = new Bedroom($area1);
        $flat->addRoom($bedroom);
        $this->assertEquals($area1, $flat->getArea());

        $livingRoom = new LivingRoom($area2);
        $flat->addRoom($livingRoom);
        $balcony = new Balcony($area3);
        $flat->addRoom($balcony);
        $expectedArea = $area1 + $area2 + $area3;
        $this->assertEquals($expectedArea, $flat->getArea());
    }
}