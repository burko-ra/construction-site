<?php

namespace ConstructionSite\Furnishings;

use ConstructionSite\Traits\CalculationTrait;

abstract class AbstractFurnishing implements FurnishingInterface
{
    protected $unitPrice;
    protected $count;
    protected $id;

    public function __construct()
    {
        $this->id = uniqid("furnishing_");
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUnitPrice()
    {
        return $this->unitPrice;
    }

    public function getCount()
    {
        return $this->count;
    }

    public function setCount($count)
    {
        $this->count = $count;
    }

    public function getTotalPrice()
    {
        return $this->count * $this->unitPrice;
    }
}
