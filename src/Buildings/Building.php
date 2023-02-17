<?php

namespace ConstructionSite\Buildings;

use ConstructionSite\Levels\LevelFactory;
use SplObjectStorage;
use SplObserver;
use SplSubject;

class Building implements BuildingInterface, GetAreaInterface, SplSubject
{
    private $levelFactory;
    private $levels;
    private $pricePerSquareMeter;
    private SplObjectStorage $observers;

    public function __construct(LevelFactory $levelFactory)
    {
        $this->levelFactory = $levelFactory;
        $this->observers = new SplObjectStorage();
    }

    public function addLevel()
    {
        $level = $this->levelFactory->createLevel();
        $levelId = $level->getId();
        $this->levels[$levelId] = $level;
    }

    public function getArea()
    {
        return array_reduce(
            $this->levels,
            fn($acc, $item) => $acc + $item->getArea(),
            0
        );
    }

    public function getLevels()
    {
        return $this->levels;
    }

    public function getFlats($mainRoomCount = null)
    {
        return array_reduce(
            $this->levels,
            fn($acc, $level) => array_merge($acc, $level->getFlats($mainRoomCount)),
            []
        );
    }

    public function getLevelById($id)
    {
        return $this->levels[$id];
    }

    public function setPricePerSquareMeter($pricePerSquareMeter)
    {
        $this->pricePerSquareMeter = $pricePerSquareMeter;
        array_map(
            fn($level) => $level->setPricePerSquareMeter($pricePerSquareMeter),
            $this->levels
        );
        $this->notify();
    }

    public function getPricePerSquareMeter()
    {
        return $this->pricePerSquareMeter;
    }

    public function getFlatCount($mainRoomCount = null)
    {
        return count($this->getFlats($mainRoomCount));
    }

    public function attach(SplObserver $observer): void
    {
        $this->observers->attach($observer);
    }

    public function detach(SplObserver $observer): void
    {
        $this->observers->detach($observer);
    }

    public function notify(): void
    {
        /** @var SplObserver $observer */
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }

    public function getObservers()
    {
        return $this->observers;
    }
}