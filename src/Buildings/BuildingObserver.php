<?php

namespace ConstructionSite\Buildings;

use SplObserver;
use SplSubject;

class BuildingObserver implements SplObserver
{
    public function update(SplSubject $subject): void
    {
        /** @var BuildingInterface $subject */
        $pricePerSquareMeter = round($subject->getPricePerSquareMeter());
        print("BuildingObserver - Стоимость квадратного метра обновлена. Новое значение - {$pricePerSquareMeter}\n");
    }
}