<?php

namespace ConstructionSite\Flats;

use ConstructionSite\Rooms\RoomInterface;

interface FlatInterface
{
    public function getId();

    public function getRooms();

    public function getRoomById($id);

    public function getRoomsByType($type);

    public function getMainRoomCount();

    public function calculateArea();

    public function addRoom(RoomInterface $room);

    public function updateRoom(RoomInterface $room);

    public function setPricePerSquareMeter($pricePerSquareMeter);

    public function getTotalPrice();
}
