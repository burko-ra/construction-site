<?php

namespace ConstructionSite\Furnishings;

interface FurnishingInterface
{
    public function getUnitPrice(): float;

    public function getCount(): int;

    public function setCount(int $count): void;

    public function getTotalPrice(): float;

    public function getId(): string;
}
