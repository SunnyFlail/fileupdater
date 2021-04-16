<?php

namespace SunnyFlail\FileUpdater;

class AppendedLines implements \Iterator
{
    
    public function getEndPointer(): int
    {
        return $this->start + count($this->lines);
    }

}