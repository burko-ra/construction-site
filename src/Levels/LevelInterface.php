<?php

namespace ConstructionSite\Levels;

use ConstructionSite\Flats\FlatInterface;

interface LevelInterface
{
    /**
     * @return array<string,FlatInterface>
     */
    public function getFlats(int $mainRoomCount = null);

    public function getId(): int;

    /**
     * @return FlatInterface
     */
    public function getFlatById(string $id);

    public function addFlat(FlatInterface $flat): void;

    public function getFlatCount(int $mainRoomCount = null): int;

    public function setPricePerSquareMeter(float $pricePerSquareMeter): void;
}
