<?php

namespace ConstructionSite\Rooms;

use ConstructionSite\Furnishings\Furnishing;
use ConstructionSite\Furnishings\FurnishingInterface;

class RoomDecorator implements RoomInterface
{
    protected RoomInterface $room;
    protected $furnishings = [];

    public function __construct(RoomInterface $room)
    {
        $this->room = $room;
    }

    public function addFurnishing(FurnishingInterface $furnishing, $count = 1)
    {
        $furnishing->setCount($count);
        $this->furnishings[] = $furnishing;
    }

    public function getFurnishings()
    {
        return $this->furnishings;
    }

    public function getFurnishingById($id)
    {
        return $this->furnishings[$id];
    }

    public function getArea()
    {
        return $this->room->getArea();
    }

    public function checkIsMain()
    {
        return $this->room->checkIsMain();
    }

    public function getType()
    {
        return $this->room->getType();
    }

    public function getId()
    {
        return $this->room->getId();
    }

    public function setPricePerSquareMeter($pricePerSquareMeter)
    {
        $this->room->setPricePerSquareMeter($pricePerSquareMeter);
    }

    public function getTotalPrice()
    {
        $baseRoomTotalPrice = $this->room->getTotalPrice();
        $furnishingsTotalPrice = array_reduce(
            $this->furnishings,
            fn($acc, $furnishing) => $acc + $furnishing->getTotalPrice(),
            0
        );

        return $baseRoomTotalPrice + $furnishingsTotalPrice;
    }
}
