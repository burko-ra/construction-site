<?php

namespace ConstructionSite\Buildings;

interface GetFlatsInterface
{
    public function getFlats();

    public function getFlatCount($mainRoomCount = null);
}