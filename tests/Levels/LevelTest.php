<?php

namespace ConstructionSite\Tests\Buildings;

use PHPUnit\Framework\TestCase; 
use ConstructionSite\Buildings\Building;
use ConstructionSite\Flats\FlatBuilder;
use ConstructionSite\Flats\FlatDirector;
use ConstructionSite\Levels\LevelFactory;

class LevelTest extends TestCase
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

    public function testGetFlatCount(): void
    {
        $this->building->addLevel();
        $this->building->addLevel();
        $level1 = $this->building->getLevelById(1);
        $level2 = $this->building->getLevelById(2);

        $this->assertEquals(0, $level1->getFlatCount());
        $flat1 = $this->flatDirector->buildOneRoomFlat();
        $level1->addFlat($flat1);
        $this->assertEquals(1, $level1->getFlatCount());

        $flat2 = $this->flatDirector->buildOneRoomFlat();
        $level2->addFlat($flat2);
        $this->assertEquals(1, $level1->getFlatCount());

        $flat3 = $this->flatDirector->buildOneRoomFlat();
        $flat4 = $this->flatDirector->buildTwoRoomFlat();
        $level1->addFlat($flat3);
        $level1->addFlat($flat4);
        $this->assertEquals(3, $level1->getFlatCount());
        $this->assertEquals(2, $level1->getFlatCount(1));
    }
}