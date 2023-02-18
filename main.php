<?php

require_once __DIR__ . '/vendor/autoload.php';

use ConstructionSite\Buildings\Building;
use ConstructionSite\Buildings\BuildingDecorator;
use ConstructionSite\Buildings\BuildingObserver;
use ConstructionSite\CommonAmenities\Doorphone;
use ConstructionSite\CommonAmenities\Elevator;
use ConstructionSite\CommonAmenities\Lighting;
use ConstructionSite\Flats\FlatBuilder;
use ConstructionSite\Flats\FlatDirector;
use ConstructionSite\Furnishings\BathroomTiles;
use ConstructionSite\Furnishings\Door;
use ConstructionSite\Levels\LevelFactory;
use ConstructionSite\Rooms\RoomDecorator;
use ConstructionSite\Specifications\MainRoomCountSpecification;

//Создаем здание
$building = new Building(new LevelFactory);

//Прикрепляем к нему observer. Он будет выводить на экран сообщения об изменении цены за кв.м.
$observer = new BuildingObserver();
$building->attach($observer);

//Создаем билдер и директор для квартир. Директор отвечает за стандартные планировки
$flatBuilder = new FlatBuilder();
$flatDirector = new FlatDirector($flatBuilder);

//Заполняем пять этажей дома стандартными квартирами
$standartLevelsCount = 5;
for ($i = 1; $i <= $standartLevelsCount; $i++) {
    $building->addLevel();
    $level = $building->getLevelById($i);

    $flats = [
        $flatDirector->buildOneRoomFlat(),
        $flatDirector->buildThreeRoomFlat(),
        $flatDirector->buildTwoRoomFlat(),
        $flatDirector->buildTwoRoomFlat()
    ];

    array_map(fn($flat) => $level->addFlat($flat), $flats);
}

//Создаем нестандартную квартуру на шестом этаже напрямую через билдер
$building->addLevel();
$level6 = $building->getLevelById(6);
$flatBuilder->produceLivingRoom(28);
$flatBuilder->produceBedroom(20);
$flatBuilder->produceBedroom(15);
$flatBuilder->produceHallway(4);
$flatBuilder->produceKitchen(12);
$flatBuilder->produceRestroom(6);
$flatBuilder->produceBathroom(9);
$flatBuilder->produceBalcony(3);
$customFlat = $flatBuilder->getFlat();
$level6->addFlat($customFlat);

//Устанавливаем цену в доме за 1 кв.м.
$building->setPricePerSquareMeter(1000);

//Рассчитываем стоимость квартиры
print("Стоимость квартиры без отделки: {$customFlat->getTotalPrice()}\n");

//Добавляем в комнату отделку
$bathrooms = $customFlat->getRoomsByType('bathroom');
$bathroom = reset($bathrooms);
$bathroomWithFurnishings = new RoomDecorator($bathroom);
$bathroomWithFurnishings->addFurnishing(new BathroomTiles(36));
$bathroomWithFurnishings->addFurnishing(new Door());
$customFlat->updateRoom($bathroomWithFurnishings);

//Рассчитываем стоимость квартиры
print("Стоимость квартиры с отделкой: {$customFlat->getTotalPrice()}\n");

//Добавляем в дом лифт, освещение и домофон. BuildingObserver выводит сообщение об обновлении цены за кв.м.
$buildingWithCommonAmenities = new BuildingDecorator($building);
$buildingWithCommonAmenities->addCommonAmenity(new Elevator());
$buildingWithCommonAmenities->addCommonAmenity(new Lighting());
$buildingWithCommonAmenities->addCommonAmenity(new Doorphone());

//Рассчитываем стоимость квартиры с учетом общедомового имущества
$customFlatInDecoratedBuildingTotalPrice = round($customFlat->getTotalPrice());
print("Стоимость квартиры с отделкой в доме с лифтом и т.д.: {$customFlatInDecoratedBuildingTotalPrice}\n");

//Находим количество двухкомнатных квартир в доме. Фильтр по квартирам - с помощью спецификации MainRoomCountSpecification
//Фильтр по квартирам - с помощью спецификации MainRoomCountSpecification
//Обращение к квартирам - через компоновщик GetFlatsInterface
$mainRoomCount = 2;
print("Количество {$mainRoomCount}-комнатных квартир в доме: {$building->getFlatCount($mainRoomCount)} \n");

//Находим количество двухкомнатных квартир на 3 этаже напрямую через спецификацию
$levelId = 3;
$twoMainRoomSpecification = new MainRoomCountSpecification(2);
$level3 = $building->getLevelById($levelId);
$twoRoomOnThirdFloorCount = count(array_filter(
    $level->getFlats(),
    fn($flat) => $twoMainRoomSpecification->isSatisfiedBy($flat)
));
print("Количество {$mainRoomCount}-комнатных квартир на {$levelId} этаже: {$twoRoomOnThirdFloorCount} \n");
