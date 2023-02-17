<?php

namespace ConstructionSite\Specifications;

use ConstructionSite\Flats\FlatInterface;

class MainRoomCountSpecification
{
    private $mainRoomCount;

    public function __construct(int $mainRoomCount = null)
    {
        $this->mainRoomCount = $mainRoomCount;
    }

    public function isSatisfiedBy(FlatInterface $flat)
    {
        return ($flat->getMainRoomCount() === $this->mainRoomCount) ||
            ($this->mainRoomCount === null);
    }
}
