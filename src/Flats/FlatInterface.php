<?php

namespace ConstructionSite\Flats;

use ConstructionSite\Rooms\RoomInterface;

interface FlatInterface
{
    public function getId(): string;

    /**
     * @return array<string,RoomInterface>
     */
    public function getRooms();

    public function getRoomById(string $id): RoomInterface;

    /**
     * @return array<string,RoomInterface>
     */
    public function getRoomsByType(string $type);

    public function getMainRoomCount(): int;

    public function calculateArea(): float;

    public function addRoom(RoomInterface $room): void;

    public function updateRoom(RoomInterface $room): void;

    public function setPricePerSquareMeter(float $pricePerSquareMeter): void;

    public function getTotalPrice(): float;
}
