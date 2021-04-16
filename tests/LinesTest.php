<?php

namespace SunnyFlail\FileUpdater\Tests;

use \PHPUnit\Framework\TestCase;
use \SunnyFlail\FileUpdater\AbstractLines;

class LinesTest extends TestCase
{

    /**
    * @dataProvider toArrayProvider
    */
    public function testToArray(string $text, array $expected)
    {
        $result = AbstractLines::toArray($text);

        $this->assertEquals(
            $expected,
            $result
        );
    }

    public function toArrayProvider()
    {
        return [
            "one line" => ["Blah blah blah", ["Blah blah blah"]],
            "multipleLinesUnix" => ["First Line\nSecond Line\nThird Line", ["First Line", "Second Line", "Third Line"]],
            "multipleLinesMac" => ["First Line\rSecond Line\rThird Line", ["First Line", "Second Line", "Third Line"]],
            "multipleLinesWindows" => ["First Line\r\nSecond Line\r\nThird Line", ["First Line", "Second Line", "Third Line"]]
        ];
    }

}