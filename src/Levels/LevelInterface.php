<?php

namespace ConstructionSite\Levels;

use ConstructionSite\Flats\FlatInterface;

interface LevelInterface
{
    public function addFlat(FlatInterface $flat): void;

    public function getId(): int;

    public function setPricePerSquareMeter(float $pricePerSquareMeter): void;
}
