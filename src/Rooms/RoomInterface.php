<?php

namespace ConstructionSite\Rooms;

interface RoomInterface
{
    public function checkIsMain(): bool;

    public function getType(): string;

    public function getId(): string;

    public function getArea(): float;

    public function setPricePerSquareMeter(float $pricePerSquareMeter): void;

    public function getTotalPrice(): float;
}
