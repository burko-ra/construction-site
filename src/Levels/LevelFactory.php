<?php

namespace ConstructionSite\Levels;

class LevelFactory
{
    private $lastLevelId = 0;

    public function createLevel()
    {
        $id = $this->generateId();
        return new Level($id);
    }

    private function generateId()
    {
        $this->lastLevelId += 1;
        return $this->lastLevelId;
    }
}
