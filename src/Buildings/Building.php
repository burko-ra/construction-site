<?php

namespace ConstructionSite\Buildings;

use ConstructionSite\Exceptions\FlatNotFoundException;
use ConstructionSite\Levels\LevelFactory;
use ConstructionSite\Levels\LevelInterface;
use ConstructionSite\Flats\FlatInterface;
use ConstructionSite\Buildings\GetFlatsInterface;
use SplObjectStorage;
use SplObserver;
use SplSubject;

class Building implements BuildingInterface, GetAreaInterface, GetFlatsInterface, SplSubject
{
    private LevelFactory $levelFactory;
    /**
     * @var array<int,LevelInterface&\ConstructionSite\Buildings\GetFlatsInterface>
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

    public function getLevelById(int $id): LevelInterface&GetFlatsInterface
    {
        return $this->levels[$id];
    }

    /**
     * @return array<int,LevelInterface>
     */
    public function getLevels()
    {
        return $this->levels;
    }

    public function getPricePerSquareMeter(): float
    {
        return $this->pricePerSquareMeter;
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


    public function getArea(): float
    {
        /**
         * @var array<int,GetAreaInterface>
         */
        $levels = $this->levels;
        return array_reduce(
            $levels,
            fn($acc, $item) => $acc + $item->getArea(),
            0
        );
    }

    public function getFlatById(string $id): FlatInterface
    {
        /**
         * @var array<int,GetFlatsInterface>
         */
        $levels = $this->levels;
        foreach ($levels as $level) {
            try {
                $flat = $level->getFlatById($id);
                return $flat;
            } catch (FlatNotFoundException $e) {
            }
        }
        throw new FlatNotFoundException("Cannot find the flat with id = {$id}");
    }

    public function getFlatCount(int $mainRoomCount = null): int
    {
        return count($this->getFlats($mainRoomCount));
    }

    /**
     * @return array<string,FlatInterface>
     */
    public function getFlats(int $mainRoomCount = null)
    {
        /**
         * @var array<int,GetFlatsInterface>
         */
        $levels = $this->levels;
        return array_reduce(
            $levels,
            fn($acc, $level) => array_merge($acc, $level->getFlats($mainRoomCount)),
            []
        );
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
}
