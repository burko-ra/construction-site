<?php

namespace ConstructionSite\Flats;

use ConstructionSite\Flats\FlatInterface;

interface FlatBuilderInterface
{
    /**
     * @return FlatInterface
     */
    public function getFlat();

    public function produceBedroom(float $area = null): void;

    public function produceBalcony(float $area = null): void;

    public function produceBathroom(float $area = null): void;

    public function produceKitchen(float $area = null): void;

    public function produceLivingRoom(float $area = null): void;

    public function produceRestroom(float $area = null): void;

    public function produceHallway(float $area = null): void;

    public function reset(FlatInterface $flat = null): void;
}
