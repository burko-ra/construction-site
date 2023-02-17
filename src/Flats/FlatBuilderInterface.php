<?php

namespace ConstructionSite\Flats;

interface FlatBuilderInterface
{
    public function getFlat();

    public function produceBedroom(int $area = null);

    public function produceBalcony(int $area = null);

    public function produceBathroom(int $area = null);

    public function produceKitchen(int $area = null);

    public function produceLivingRoom(int $area = null);

    public function produceRestroom(int $area = null);

    public function produceHallway(int $area = null);

    public function reset(FlatInterface $flat = null);
}
