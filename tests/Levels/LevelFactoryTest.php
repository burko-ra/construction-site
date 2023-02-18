<?php

namespace ConstructionSite\Tests\Buildings;

use PHPUnit\Framework\TestCase; 
use ConstructionSite\Buildings\Building;
use ConstructionSite\Flats\FlatBuilder;
use ConstructionSite\Flats\FlatDirector;
use ConstructionSite\Levels\Level;
use ConstructionSite\Levels\LevelFactory;

class LevelFactoryTest extends TestCase
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

    public function testCreateLevel(): void
    {
        $level = $this->levelFactory->createLevel(1);
        $this->assertInstanceOf(Level::class, $level);
    }
}