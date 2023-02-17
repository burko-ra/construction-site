<?php

namespace ConstructionSite\Rooms;

interface RoomInterface
{
    public function checkIsMain();

    public function getType();

    public function getId();

    public function getArea();

    public function setPricePerSquareMeter($pricePerSquareMeter);

    public function getTotalPrice();
}