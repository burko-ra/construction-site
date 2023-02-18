<?php

namespace ConstructionSite\Rooms;

use ConstructionSite\Furnishings\Furnishing;
use ConstructionSite\Furnishings\FurnishingInterface;
use ConstructionSite\Buildings\GetAreaInterface;

class RoomDecorator implements RoomInterface
{
    protected RoomInterface $room;
    /**
     * @var array<string,FurnishingInterface>
     */
    protected $furnishings = [];

    public function __construct(RoomInterface $room)
    {
        $this->room = $room;
    }

    public function addFurnishing(FurnishingInterface $furnishing): void
    {
        $this->furnishings[] = $furnishing;
    }

    /**
     * @return array<string,FurnishingInterface>
     */
    public function getFurnishings()
    {
        return $this->furnishings;
    }

    public function getFurnishingById(string $id): FurnishingInterface
    {
        return $this->furnishings[$id];
    }

    public function getArea(): float
    {
        /**
         * @var GetAreaInterface
         */
        $room = $this->room;
        return $room->getArea();
    }

    public function checkIsMain(): bool
    {
        return $this->room->checkIsMain();
    }

    public function getType(): string
    {
        return $this->room->getType();
    }

    public function getId(): string
    {
        return $this->room->getId();
    }

    public function setPricePerSquareMeter(float $pricePerSquareMeter): void
    {
        $this->room->setPricePerSquareMeter($pricePerSquareMeter);
    }

    public function getTotalPrice(): float
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
