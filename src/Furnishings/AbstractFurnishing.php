<?php

namespace ConstructionSite\Furnishings;

use ConstructionSite\Traits\CalculationTrait;

abstract class AbstractFurnishing implements FurnishingInterface
{
    protected float $unitPrice;
    protected int $count;
    protected string $id;

    public function __construct()
    {
        $this->id = uniqid("furnishing_");
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getUnitPrice(): float
    {
        return $this->unitPrice;
    }

    public function getCount(): int
    {
        return $this->count;
    }

    public function setCount(int $count): void
    {
        $this->count = $count;
    }

    public function getTotalPrice(): float
    {
        return $this->count * $this->unitPrice;
    }
}
