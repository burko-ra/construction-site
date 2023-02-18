<?php

namespace ConstructionSite\Levels;

use ConstructionSite\Buildings\GetAreaInterface;
use ConstructionSite\Buildings\GetFlatsInterface;
use ConstructionSite\Exceptions\FlatNotException;
use ConstructionSite\Exceptions\FlatNotFoundException;
use ConstructionSite\Flats\FlatInterface;
use ConstructionSite\Specifications\MainRoomCountSpecification;

class Level implements LevelInterface, GetAreaInterface, GetFlatsInterface
{
    /**
     * @var array<string,FlatInterface>
     */
    private $flats;
    protected int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function getArea(): float
    {
        /**
         * @var array<string,FlatInterface&GetAreaInterface>
         */
        $flats = $this->flats;
        return array_reduce(
            $flats,
            fn($acc, $item) => $acc + $item->getArea(),
            0
        );
    }

    /**
     * @return array<string,FlatInterface>
     */
    public function getFlats(int $mainRoomCount = null)
    {
        $mainRoomCountSpecification = new MainRoomCountSpecification($mainRoomCount);
        return array_filter($this->flats, fn($flat) => $mainRoomCountSpecification->isSatisfiedBy($flat));
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFlatById(string $id): FlatInterface
    {
        return $this->flats[$id] ?? throw new FlatNotFoundException("Cannot find the flat with id = {$id}");
    }

    public function addFlat(FlatInterface $flat): void
    {
        $flatId = $flat->getId();
        $this->flats[$flatId] = $flat;
    }

    public function getFlatCount(int $mainRoomCount = null): int
    {
        return count($this->getFlats($mainRoomCount));
    }

    public function setPricePerSquareMeter(float $pricePerSquareMeter): void
    {
        array_map(
            fn($flat) => $flat->setPricePerSquareMeter($pricePerSquareMeter),
            $this->flats
        );
    }
}
