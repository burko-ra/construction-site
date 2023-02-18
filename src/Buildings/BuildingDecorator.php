<?php

namespace ConstructionSite\Buildings;

use ConstructionSite\CommonAmenities\CommonAmenityInterface;
use ConstructionSite\Levels\LevelInterface;
use SplObserver;
use SplSubject;

class BuildingDecorator implements BuildingInterface, GetAreaInterface, GetFlatsInterface
{
    protected BuildingInterface&GetAreaInterface $building;
    protected $commonAmenities = [];
    protected $basePricePerSquareMeter;

    public function __construct(BuildingInterface $building)
    {
        $this->building = $building;
        $this->basePricePerSquareMeter = $building->getPricePerSquareMeter();
    }

    public function addCommonAmenity(CommonAmenityInterface $commonAmenity)
    {
        $id = $commonAmenity->getId();
        $this->commonAmenities[$id] = $commonAmenity;
        $this->updateTotalPricePerSquareMeter();
    }

    /**
     * @return array<string,CommonAmenityInterface>
     */
    public function getCommonAmenities()
    {
        return $this->commonAmenities;
    }

    public function addLevel(): void
    {
        $this->building->addLevel();
    }

    public function calculateTotalPricePerSquareMeter(): float
    {
        $buildingArea = $this->getArea();
        $baseTotalPrice = $this->basePricePerSquareMeter * $buildingArea;

        $commonAmenitiesTotalPrice = array_reduce(
            $this->commonAmenities,
            fn($acc, $commonAmenity) => $acc + $commonAmenity->getPrice(),
            0
        );

        $totalPrice = $baseTotalPrice + $commonAmenitiesTotalPrice;
        return $totalPrice / $buildingArea;
    }

    public function setPricePerSquareMeter(float $basePricePerSquareMeter): void
    {
        $totalPricePerSquareMeter = $this->calculateTotalPricePerSquareMeter();
        $this->building->setPricePerSquareMeter($totalPricePerSquareMeter);
    }

    protected function updateTotalPricePerSquareMeter()
    {
        $totalPricePerSquareMeter = $this->calculateTotalPricePerSquareMeter();
        $this->building->setPricePerSquareMeter($totalPricePerSquareMeter);
    }

    public function getPricePerSquareMeter(): float
    {
        return $this->basePricePerSquareMeter;
    }

    public function getTotalPricePerSquareMeter(): float
    {
        return $this->calculateTotalPricePerSquareMeter();
    }

    public function calculateCommonAmenitiesTotalPrice()
    {
        return array_reduce($this->commonAmenities, function ($acc, $item) {
            return $acc + $item->getPrice();
        }, 0);
    }

    public function getArea(): float
    {
        return $this->building->getArea();
    }

    /**
     * @return array<string,LevelInterface>
     */
    public function getLevels()
    {
        return $this->building->getLevels();
    }

    public function getLevelById(int $id): LevelInterface
    {
        return $this->building->getLevelById($id);
    }

    public function getFlats($mainRoomCount = null)
    {
        return array_reduce(
            $this->building->getLevels(),
            fn($acc, $level) => array_merge($acc, $level->getFlats($mainRoomCount)),
            []
        );
    }

    public function getFlatCount(int $mainRoomCount = null): int
    {
        return count($this->getFlats($mainRoomCount));
    }
}
