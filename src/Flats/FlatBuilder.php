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
    /**
     * @var FlatInterface
     */
    private $flat;

    public function __construct(FlatInterface $flat = null)
    {
        $this->reset($flat);
    }

    /**
     * @return FlatInterface
     */
    public function getFlat()
    {
        $flat = $this->flat;
        $this->reset();
        return $flat;
    }

    public function produceBedroom(?float $area = 15): void
    {
        $this->flat->addRoom(new Bedroom($area));
    }

    public function produceBalcony(?float $area = 5): void
    {
        $this->flat->addRoom(new Balcony($area));
    }

    public function produceBathroom(?float $area = 10): void
    {
        $this->flat->addRoom(new Bathroom($area));
    }

    public function produceKitchen(?float $area = 15): void
    {
        $this->flat->addRoom(new Kitchen($area));
    }

    public function produceLivingRoom(?float $area = 25): void
    {
        $this->flat->addRoom(new LivingRoom($area));
    }

    public function produceRestroom(?float $area = 5): void
    {
        $this->flat->addRoom(new Restroom($area));
    }

    public function produceHallway(?float $area = 5): void
    {
        $this->flat->addRoom(new Hallway($area));
    }

    public function reset(FlatInterface $flat = null): void
    {
        $this->flat = $flat ?? new Flat();
    }
}
