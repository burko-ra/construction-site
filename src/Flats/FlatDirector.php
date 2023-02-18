<?php

namespace ConstructionSite\Flats;

class FlatDirector
{
    private FlatBuilderInterface $flatBuilder;

    public function __construct(FlatBuilderInterface $flatBuilder)
    {
        $this->flatBuilder = $flatBuilder;
    }
    public function buildOneRoomFlat(): FlatInterface
    {
        $this->flatBuilder->reset();
        $this->flatBuilder->produceLivingRoom();
        $this->flatBuilder->produceKitchen();
        $this->flatBuilder->produceBathroom();
        $this->flatBuilder->produceRestroom();
        $this->flatBuilder->produceBalcony();
        return $this->flatBuilder->getFlat();
    }

    public function buildTwoRoomFlat(): FlatInterface
    {
        $this->flatBuilder->reset();
        $this->flatBuilder->produceLivingRoom();
        $this->flatBuilder->produceBedroom();
        $this->flatBuilder->produceKitchen();
        $this->flatBuilder->produceBathroom();
        $this->flatBuilder->produceRestroom();
        $this->flatBuilder->produceBalcony();
        return $this->flatBuilder->getFlat();
    }

    public function buildThreeRoomFlat(): FlatInterface
    {
        $this->flatBuilder->reset();
        $this->flatBuilder->produceLivingRoom();
        $this->flatBuilder->produceBedroom();
        $this->flatBuilder->produceBedroom();
        $this->flatBuilder->produceKitchen();
        $this->flatBuilder->produceBathroom();
        $this->flatBuilder->produceRestroom();
        $this->flatBuilder->produceRestroom();
        $this->flatBuilder->produceBalcony();
        $this->flatBuilder->produceBalcony();
        return $this->flatBuilder->getFlat();
    }
}
