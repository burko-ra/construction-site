<?php

namespace ConstructionSite\Flats;

use ConstructionSite\Buildings\GetAreaInterface;
use ConstructionSite\Rooms\RoomInterface;

class Flat implements FlatInterface, GetAreaInterface
{
    protected string $id;
    /**
     * @var array<string,RoomInterface>
     */
    protected $rooms = [];
    protected int $mainRoomCount = 0;

    public function __construct()
    {
        $this->id = uniqid("flat_");
    }

    public function addRoom(RoomInterface $room): void
    {
        $roomId = $room->getId();
        $this->rooms[$roomId] = $room;
        $this->calculateMainRoomCount();
    }

    protected function calculateMainRoomCount(): void
    {
        $this->mainRoomCount = array_reduce($this->rooms, function ($acc, $item) {
            return ($item->checkIsMain() ? 1 : 0) + $acc;
        }, 0);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getMainRoomCount(): int
    {
        return $this->mainRoomCount;
    }

    public function getRoomById(string $id): RoomInterface
    {
        return $this->rooms[$id] ?? throw new \Exception("Cannot find the room with id = {$id}");
    }

    /**
     * @return array<string,RoomInterface>
     */
    public function getRooms()
    {
        return $this->rooms;
    }

    /**
     * @return array<string,RoomInterface>
     */
    public function getRoomsByType(string $type)
    {
        return array_filter(
            $this->rooms,
            fn($item) => $item->getType() === $type
        );
    }

    public function getTotalPrice(): float
    {
        return array_reduce($this->rooms, fn($acc, $room) => $acc + $room->getTotalPrice(), 0);
    }

    public function setPricePerSquareMeter(float $pricePerSquareMeter): void
    {
        array_map(
            fn($room) => $room->setPricePerSquareMeter($pricePerSquareMeter),
            $this->rooms
        );
    }

    public function updateRoom(RoomInterface $room): void
    {
        $roomId = $room->getId();
        $roomToUpdate = $this->getRoomById($roomId);
        $this->rooms[$roomId] = $room;
        $this->calculateMainRoomCount();
    }


    public function getArea(): float
    {
        /**
         * @var array<string,GetAreaInterface>
         */
        $rooms = $this->rooms;
        return array_reduce(
            $rooms,
            fn($acc, $item) => $acc + $item->getArea(),
            0
        );
    }
}
