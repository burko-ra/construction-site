<?php

namespace ConstructionSite\Rooms;

use ConstructionSite\Buildings\GetAreaInterface;

abstract class AbstractRoom implements RoomInterface, GetAreaInterface
{
    private $area;
    private $id;
    protected static bool $isMain;
    protected static string $type;
    protected $pricePerSquareMeter;

    public function __construct($area)
    {
        $this->area = $area;
        $this->id = uniqid("room_");
    }

    public function getArea(): float
    {
        return $this->area;
    }

    public function checkIsMain(): bool
    {
        return static::$isMain;
    }

    public function getType(): string
    {
        return static::$type;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setPricePerSquareMeter($pricePerSquareMeter): void
    {
        $this->pricePerSquareMeter = $pricePerSquareMeter;
    }

    public function getTotalPrice(): float
    {
        if (!$this->pricePerSquareMeter) {
            throw new \Exception("Price per square meter is not set. Cannot calculate the total price.");
        }

        return $this->pricePerSquareMeter * $this->area;
    }
}
