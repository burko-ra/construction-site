<?php

namespace ConstructionSite\CommonAmenities;

abstract class AbstractCommonAmenity implements CommonAmenityInterface
{
    protected float $price;
    protected string $id;

    public function __construct()
    {
        $this->id = uniqid("common_amenity_");
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}
