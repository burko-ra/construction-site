<?php

namespace ConstructionSite\Rooms;

interface RoomInterface
{
    public function checkIsMain(): bool;

    public function getId(): string;

    public function getTotalPrice(): float;

    public function getType(): string;

    public function setPricePerSquareMeter(float $pricePerSquareMeter): void;
}
