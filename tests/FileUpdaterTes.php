<?php

namespace SunnyFlail\FileUpdater\Tests;

use \PHPUnit\Framework\TestCase;

class FileUpdaterTest extends TestCase
{
 
    protected const FILES_PATH = __DIR__."/files/";
    protected const TEMPLATE_PATH = self::FILES_PATH.'TEMPLATE';
    protected const TEST_FILE_PATH = self::FILES_PATH.'TEST_FILE';

    public function setUp()
    {
        if (!is_readable(TEMPLATE_PATH)) {
            throw new \Exception("TEMPLATE FILE CORRUPTED!");
        }
    }

    /**
    * @before
    */
    public function resetTestFile()
    {
        copy(self::TEMPLATE_PATH, self::TEST_FILE_PATH);
    }


    public function testAppendingSingleLine()
    {

    }

    public function testAppendingMultipleLines()
    {

    }

    public function testChangingSingleLine()
    {

    }

    public function testChangingMultipleLines()
    {

    }

    public function tearDown()
    {
        unlink(TEST_FILE_PATH);
    }

}