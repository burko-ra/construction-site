<?php

namespace ConstructionSite\Buildings;

use ConstructionSite\Flats\FlatInterface;

interface GetFlatsInterface
{
    public function getFlatCount(int $mainRoomCount = null): int;

    /**
     * @return array<string,FlatInterface>
     */
    public function getFlats(int $mainRoomCount = null);
}
