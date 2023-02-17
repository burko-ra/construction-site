<?php

namespace ConstructionSite\CommonAmenities;

abstract class AbstractCommonAmenity implements CommonAmenityInterface
{
    protected $price;
    protected $id;

    public function __construct()
    {
        $this->id = uniqid("common_amenity_");
    }

    public function getId()
    {
        return $this->id;
    }

    public function getPrice()
    {
        return $this->price;
    }
}
