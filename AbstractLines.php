<?php

namespace SunnyFlail\FileEditor;

abstract class AbstractLines
{

    protected array $lines;

    public function __construct(
        protected int $startLine
    ) {
        $this->lines = [];
    }

    public function append(string|array $lines)
    {
        if (is_string($lines)) {
            $lines = self::splitLines($lines);
        }

        $this->lines += $lines;
    }

    public function getCount(): int
    {
        return count($this->lines);
    }

    public function getStartLine(): int
    {
        return $this->startLine;
    }

    public function __toString(): string
    {
        return implode(PHP_EOL, $this->lines);
    }

    /**
     * Splits text to array of lines
     */
    public static function splitLines(string $text): array
    {
        return preg_split("/\\r\\n|\\r|\\n/", $text);
    }

    abstract public function getEndLine(): int;

}