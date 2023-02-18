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
use ConstructionSite\Rooms\Kitchen;
use ConstructionSite\Rooms\LivingRoom;
use ConstructionSite\Rooms\RoomDecorator;

use function PHPUnit\Framework\assertTrue;

class RoomTest extends TestCase
{
    public function testGetArea(): void
    {
        $area = 20;
        $room = new Kitchen($area);
        $this->assertEquals($area, $room->getArea());
    }

    public function testCheckIsMain(): void
    {
        $livingRoom = new LivingRoom(20);
        $this->assertTrue($livingRoom->checkIsMain());

        $bathroom = new Bathroom(10);
        $this->assertfalse($bathroom->checkIsMain());

        $bedroom = new Bedroom(15);
        $this->assertTrue($bedroom->checkIsMain());

        $balcony = new Balcony(5);
        $this->assertfalse($balcony->checkIsMain());
    }
}
