<?php

namespace SunnyFlail\FileUpdater;

class OverwrittenLines extends AbstractLines implements \Iterator
{

    public function __construct(
        string|array $lines,
        int $start,
        protected int $end
    ) {
        parent::__construct($lines, $start);
    }

    public function getEndPointer(): int
    {
        return $end;
    }

}