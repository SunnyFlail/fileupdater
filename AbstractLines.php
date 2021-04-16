<?php

namespace SunnyFlail\FileUpdater;

abstract class AbstractLines implements \Iterator
{

    protected array $lines;
    protected int $current;

    public function __construct(
        string|array $lines,
        protected int $start
    ) {
        if (is_string($lines)) {
            $lines = self::toArray($lines);
        }

        $this->lines = $lines;
        $this->current = 0;
    }

    public function append(string|array $lines)
    {
        if (is_string($lines)) {
            $lines = self::toArray($lines);
        }

        $this->lines = $this->lines + $lines;
    }

    public function current(): mixed
    {
        return $this->lines[$current] ?? null;
    }

    public function key (): int
    {
        return $this->current;
    }

    public function next()
    {
        $this->current ++;
    }

    public function rewind()
    {
        $this->current = 0;
    }

    public function valid() : bool
    {
        return isset($this->lines[$this->current]);
    }

    public function getCount(): int
    {
        return count($this->lines);
    }

    /**
     * Splits text to array of lines
     */
    public static function toArray(string $text): array
    {
        return preg_split("/\\r\\n|\\r|\\n/", $text);
    }

    public function getStartPointer(): int
    {
        return $this->start;
    }

    abstract public function getEndPointer(): int;

    public function __toString(): string
    {
        return implode(PHP_EOL, $this->lines);
    }


}