<?php

namespace ConstructionSite\Specifications;

use ConstructionSite\Flats\FlatInterface;

interface SpecificationInterface
{
    public function isSatisfiedBy(FlatInterface $flat): bool;
}
