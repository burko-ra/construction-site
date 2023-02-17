<?php

namespace ConstructionSite\Buildings;

use ConstructionSite\Levels\LevelFactory;
use ConstructionSite\Levels\LevelInterface;
use SplObjectStorage;
use SplObserver;
use SplSubject;

class Building implements BuildingInterface, GetAreaInterface, GetFlatsInterface, SplSubject
{
    private LevelFactory $levelFactory;
    /**
     * @var array<string,LevelInterface&GetAreaInterface&GetFlatsInterface>
     */
    private $levels;
    private float $pricePerSquareMeter;
    private SplObjectStorage $observers;

    public function __construct(LevelFactory $levelFactory)
    {
        $this->levelFactory = $levelFactory;
        $this->observers = new SplObjectStorage();
    }

    public function addLevel(): void
    {
        $level = $this->levelFactory->createLevel();
        $levelId = $level->getId();
        $this->levels[$levelId] = $level;
    }

    public function getArea(): int
    {
        return array_reduce(
            $this->levels,
            fn($acc, $item) => $acc + $item->getArea(),
            0
        );
    }

    /**
     * @return array<string,LevelInterface&GetAreaInterface&GetFlatsInterface>
     */
    public function getLevels()
    {
        return $this->levels;
    }

    /**
     * @return array<string,FlatInterface>
     */
    public function getFlats(int $mainRoomCount = null)
    {
        return array_reduce(
            $this->levels,
            fn($acc, $level) => array_merge($acc, $level->getFlats($mainRoomCount)),
            []
        );
    }

    public function getLevelById(string $id): LevelInterface
    {
        return $this->levels[$id];
    }

    public function setPricePerSquareMeter(float $pricePerSquareMeter): void
    {
        $this->pricePerSquareMeter = $pricePerSquareMeter;
        array_map(
            fn($level) => $level->setPricePerSquareMeter($pricePerSquareMeter),
            $this->levels
        );
        $this->notify();
    }

    public function getPricePerSquareMeter(): float
    {
        return $this->pricePerSquareMeter;
    }

    public function getFlatCount(int $mainRoomCount = null): int
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

    /**
     * @return SplObjectStorage
     */
    public function getObservers()
    {
        return $this->observers;
    }
}
