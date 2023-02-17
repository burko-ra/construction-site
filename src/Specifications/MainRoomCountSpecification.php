<?php

namespace ConstructionSite\Specifications;

use ConstructionSite\Flats\FlatInterface;

class MainRoomCountSpecification
{
    private ?int $mainRoomCount;

    public function __construct(int $mainRoomCount = null)
    {
        $this->mainRoomCount = $mainRoomCount;
    }

    public function isSatisfiedBy(FlatInterface $flat): bool
    {
        return ($flat->getMainRoomCount() === $this->mainRoomCount) ||
            ($this->mainRoomCount === null);
    }
}
