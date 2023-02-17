<?php

namespace ConstructionSite\Levels;

use ConstructionSite\Buildings\GetAreaInterface;
use ConstructionSite\Buildings\GetFlatsInterface;
use ConstructionSite\Flats\FlatInterface;
use ConstructionSite\Specifications\MainRoomCountSpecification;

class Level implements LevelInterface, GetAreaInterface, GetFlatsInterface
{
    private $flats;
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function getArea()
    {
        return array_reduce(
            $this->flats,
            fn($acc, $item) => $acc + $item->getArea(),
            0
        );
    }

    public function getFlats($mainRoomCount = null)
    {
        $mainRoomCountSpecification = new MainRoomCountSpecification($mainRoomCount);
        return array_filter($this->flats, fn($flat) => $mainRoomCountSpecification->isSatisfiedBy($flat));
    }

    public function getId()
    {
        return $this->id;
    }

    public function getFlatById($id)
    {
        return $this->flats[$id] ?? throw new \Exception("Cannot find the flat with id = {$id}");
    }

    public function addFlat(FlatInterface $flat)
    {
        $flatId = $flat->getId();
        $this->flats[$flatId] = $flat;
    }

    public function getFlatCount($mainRoomCount = null)
    {
        return count($this->getFlats($mainRoomCount));
    }

    public function setPricePerSquareMeter($pricePerSquareMeter)
    {
        array_map(
            fn($flat) => $flat->setPricePerSquareMeter($pricePerSquareMeter),
            $this->flats
        );
    }
}
