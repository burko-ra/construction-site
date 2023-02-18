<?php

namespace ConstructionSite\Buildings;

use ConstructionSite\Flats\FlatInterface;

interface GetFlatsInterface
{
    /**
     * @return array<string,FlatInterface>
     */
    public function getFlats(int $mainRoomCount = null);

    public function getFlatCount(int $mainRoomCount = null): int;
}
