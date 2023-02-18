<?php

namespace ConstructionSite\Buildings;

use ConstructionSite\Levels\LevelInterface;

interface BuildingInterface
{
    public function addLevel(): void;

    public function setPricePerSquareMeter(float $pricePerSquareMeter): void;

    public function getPricePerSquareMeter(): float;

    /**
     * @return array<int,LevelInterface>
     */
    public function getLevels();

    public function getLevelById(int $id): LevelInterface;
}
