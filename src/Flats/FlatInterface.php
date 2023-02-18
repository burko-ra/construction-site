<?php

namespace ConstructionSite\Flats;

use ConstructionSite\Rooms\RoomInterface;

interface FlatInterface
{
    public function addRoom(RoomInterface $room): void;

    public function getId(): string;

    public function getMainRoomCount(): int;

    public function getRoomById(string $id): RoomInterface;

    /**
     * @return array<string,RoomInterface>
     */
    public function getRooms();

    /**
     * @return array<string,RoomInterface>
     */
    public function getRoomsByType(string $type);

    public function getTotalPrice(): float;

    public function setPricePerSquareMeter(float $pricePerSquareMeter): void;

    public function updateRoom(RoomInterface $room): void;
}
