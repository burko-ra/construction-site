<?php

namespace ConstructionSite\Levels;

use ConstructionSite\Levels\LevelInterface;

class LevelFactory
{
    private int $lastLevelId = 0;

    /**
     * @return LevelInterface
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
