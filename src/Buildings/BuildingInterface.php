<?php

namespace ConstructionSite\Buildings;

use ConstructionSite\Levels\LevelInterface;

interface BuildingInterface
{
    public function addLevel();

    public function setPricePerSquareMeter(float $pricePerSquareMeter): void;

    public function getPricePerSquareMeter(): float;

    /**
     * @return array<string,LevelInterface>
     */
    public function getLevels();

    public function getLevelById(string $id): LevelInterface;
}
