<?php

namespace SunnyFlail\FileEditor;

class OverwrittenLines extends AbstractLines
{

    public function __construct(
        int $startLine,
        protected int $endLine
    ) {
        parent::__construct($startLine);
    }

    public function getEndLine(): int
    {
        return $this->endLine;
    }

    public function getAffectedCount(): int
    {
        return $this->endLine - $this->startLine + 1;
    }

}