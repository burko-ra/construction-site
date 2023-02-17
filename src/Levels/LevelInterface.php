<?php

namespace ConstructionSite\Levels;

use ConstructionSite\Flats\FlatInterface;

interface LevelInterface
{
    public function getFlats($mainRoomCount = null);

    public function getId();

    public function getFlatById($id);

    public function addFlat(FlatInterface $flat);

    public function getFlatCount($mainRoomCount = null);

    public function setPricePerSquareMeter($pricePerSquareMeter);
}
