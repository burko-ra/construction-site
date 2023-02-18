<?php

namespace ConstructionSite\Levels;

use ConstructionSite\Levels\LevelInterface;
use ConstructionSite\Buildings\GetFlatsInterface;

class LevelFactory
{
    private int $lastLevelId = 0;

    /**
     * @return LevelInterface&\ConstructionSite\Buildings\GetFlatsInterface
     */
    public function createLevel()
    {
        $id = $this->generateId();
        return new Level($id);
    }

    private function generateId(): int
    {
        $this->lastLevelId += 1;
        return $this->lastLevelId;
    }
}
