<?php

namespace ConstructionSite\Furnishings;

interface FurnishingInterface
{
    public function getUnitPrice();

    public function getCount();

    public function setCount($count);

    public function getTotalPrice();

    public function getId();
}
