<?php

namespace ConstructionSite\Buildings;

interface GetFlatsInterface
{
    public function getFlats(int $mainRoomCount = null);

    public function getFlatCount(int $mainRoomCount = null): int;
}
