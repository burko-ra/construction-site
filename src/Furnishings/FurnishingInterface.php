<?php

namespace ConstructionSite\Furnishings;

interface FurnishingInterface
{
    public function getCount(): float;

    public function getId(): string;

    public function getTotalPrice(): float;

    public function getUnitPrice(): float;
}
