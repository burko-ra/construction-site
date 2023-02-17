<?php

namespace ConstructionSite\Rooms;

use ConstructionSite\Buildings\GetAreaInterface;

abstract class AbstractRoom implements RoomInterface, GetAreaInterface
{
    private $area;
    private $id;
    protected static $isMain;
    protected static $type;
    protected $pricePerSquareMeter;

    public function __construct($area)
    {
        $this->area = $area;
        $this->id = uniqid("room_");
    }

    public function getArea()
    {
        return $this->area;
    }

    public function checkIsMain()
    {
        return static::$isMain;
    }

    public function getType()
    {
        return static::$type;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setPricePerSquareMeter($pricePerSquareMeter)
    {
        $this->pricePerSquareMeter = $pricePerSquareMeter;
    }

    public function getTotalPrice()
    {
        if (!$this->pricePerSquareMeter) {
            throw new \Exception("Price per square meter is not set. Cannot calculate the total price.");
        }

        return $this->pricePerSquareMeter * $this->area;
    }
}