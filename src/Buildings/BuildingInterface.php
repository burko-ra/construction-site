<?php

namespace ConstructionSite\Buildings;

interface BuildingInterface
{
    public function addLevel();

    public function setPricePerSquareMeter($pricePerSquareMeter);

    public function getPricePerSquareMeter();

    public function getLevels();

    public function getLevelById($id);
}
