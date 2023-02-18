<?php

namespace ConstructionSite\Rooms;

use ConstructionSite\Buildings\GetAreaInterface;

abstract class AbstractRoom implements RoomInterface, GetAreaInterface
{
    private float $area;
    private string $id;
    protected static bool $isMain;
    protected static string $type;
    protected float $pricePerSquareMeter;

    public function __construct(float $area)
    {
        $this->area = $area;
        $this->id = uniqid("room_");
    }

    public function checkIsMain(): bool
    {
        return static::$isMain;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getTotalPrice(): float
    {
        if (!$this->pricePerSquareMeter) {
            throw new \Exception("Price per square meter is not set. Cannot calculate the total price.");
        }

        return $this->pricePerSquareMeter * $this->area;
    }

    public function getType(): string
    {
        return static::$type;
    }

    public function setPricePerSquareMeter(float $pricePerSquareMeter): void
    {
        $this->pricePerSquareMeter = $pricePerSquareMeter;
    }


    public function getArea(): float
    {
        return $this->area;
    }
}
