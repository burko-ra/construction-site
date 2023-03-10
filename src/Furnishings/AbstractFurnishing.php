<?php

namespace ConstructionSite\Furnishings;

use ConstructionSite\Traits\CalculationTrait;

abstract class AbstractFurnishing implements FurnishingInterface
{
    protected float $unitPrice;
    protected float $count;
    protected string $id;

    public function __construct(float $count = 1)
    {
        $this->id = uniqid("furnishing_");
        $this->count = $count;
    }

    public function getCount(): float
    {
        return $this->count;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getTotalPrice(): float
    {
        return $this->count * $this->unitPrice;
    }

    public function getUnitPrice(): float
    {
        return $this->unitPrice;
    }

    protected function setCount(int $count): void
    {
        $this->count = $count;
    }
}
