<?php

namespace ConstructionSite\Buildings;

use ConstructionSite\Levels\LevelInterface;

interface BuildingInterface
{
    public function addLevel(): void;

    public function getLevelById(int $id): LevelInterface;

    /**
     * @return array<int,LevelInterface>
     */
    public function getLevels();

    public function getPricePerSquareMeter(): float;

    public function setPricePerSquareMeter(float $pricePerSquareMeter): void;
}
