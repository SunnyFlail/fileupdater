<?php

namespace SunnyFlail\FileEditor;

class AppendedLines extends AbstractLines
{
    
    public function getEndLine(): int
    {
        return $this->start + count($this->lines);
    }

}