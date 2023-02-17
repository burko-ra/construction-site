<?php

namespace ConstructionSite\Flats;

use ConstructionSite\Buildings\GetAreaInterface;
use ConstructionSite\Rooms\RoomInterface;

class Flat implements FlatInterface, GetAreaInterface
{
    protected $id;
    protected $rooms = [];
    protected $mainRoomCount = 0;
    protected $lastRoomId = 0;

    public function __construct()
    {
        $this->id = uniqid("flat_");
    }

    public function getId()
    {
        return $this->id;
    }

    public function getArea()
    {
        return array_reduce(
            $this->rooms,
            fn($acc, $item) => $acc + $item->getArea(),
            0
        );
    }

    public function getRooms()
    {
        return $this->rooms;
    }

    public function getRoomById($id)
    {
        return $this->rooms[$id] ?? throw new \Exception("Cannot find the room with id = {$id}");
    }

    public function getRoomsByType($type)
    {
        return array_values(array_filter(
            $this->rooms,
            fn($item) => $item->getType() === $type
        ));
    }

    public function getMainRoomCount()
    {
        return $this->mainRoomCount;
    }

    public function calculateArea()
    {
        $area = 0;
        foreach ($this->rooms as $room)
        {
            $area += $room->getArea();
        }
        return $area;
    }

    public function addRoom(RoomInterface $room)
    {
        $roomId = $room->getId();
        $this->rooms[$roomId] = $room;
        $this->calculateMainRoomCount();
    }

    public function updateRoom(RoomInterface $room)
    {
        $roomId = $room->getId();
        $roomToUpdate = $this->getRoomById($roomId);
        if ($roomToUpdate) {
            $this->rooms[$roomId] = $room;
            $this->calculateMainRoomCount();
        }
    }

    protected function calculateMainRoomCount()
    {
        $this->mainRoomCount = array_reduce($this->rooms, function ($acc, $item) {
            return ($item->checkIsMain() ? 1 : 0) + $acc;
        }, 0);
    }

    public function setPricePerSquareMeter($pricePerSquareMeter)
    {
        array_map(
            fn($room) => $room->setPricePerSquareMeter($pricePerSquareMeter),
            $this->rooms
        );
    }

    public function getTotalPrice()
    {
        return array_reduce($this->rooms, fn($acc, $room) => $acc + $room->getTotalPrice(), 0);
    }
}
