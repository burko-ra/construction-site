<?php

namespace ConstructionSite\Buildings;

use ConstructionSite\Flats\FlatInterface;

interface GetFlatsInterface
{
    public function getFlatCount(int $mainRoomCount = null): int;

    public function getFlatById(string $id): FlatInterface;

    /**
     * @return array<string,FlatInterface>
     */
    public function getFlats(int $mainRoomCount = null);
}
