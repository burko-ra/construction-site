<?php

namespace ConstructionSite\Flats;

use ConstructionSite\Rooms\Balcony;
use ConstructionSite\Rooms\Bathroom;
use ConstructionSite\Rooms\Bedroom;
use ConstructionSite\Rooms\Hallway;
use ConstructionSite\Rooms\Kitchen;
use ConstructionSite\Rooms\LivingRoom;
use ConstructionSite\Rooms\Restroom;

class FlatBuilder implements FlatBuilderInterface
{
    private $flat;

    public function __construct(FlatInterface $flat = null)
    {
        $this->reset($flat);
    }

    public function getFlat()
    {
        $flat = $this->flat;
        $this->reset();
        return $flat;
    }

    public function produceBedroom($area = 15)
    {
        $this->flat->addRoom(new Bedroom($area));
    }

    public function produceBalcony($area = 5)
    {
        $this->flat->addRoom(new Balcony($area));
    }

    public function produceBathroom($area = 10)
    {
        $this->flat->addRoom(new Bathroom($area));
    }

    public function produceKitchen($area = 15)
    {
        $this->flat->addRoom(new Kitchen($area));
    }

    public function produceLivingRoom($area = 25)
    {
        $this->flat->addRoom(new LivingRoom($area));
    }

    public function produceRestroom($area = 5)
    {
        $this->flat->addRoom(new Restroom($area));
    }

    public function produceHallway($area = 5)
    {
        $this->flat->addRoom(new Hallway($area));
    }

    public function reset(FlatInterface $flat = null)
    {
        $this->flat = $flat ?? new Flat();
    }
}
