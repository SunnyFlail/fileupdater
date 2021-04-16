<?php

namespace SunnyFlail\FileUpdater;

use \SplFileObject;
use \SplTempFileObject;

final class FileEditor
{

    private string $filePath;
    private array $overWrittenLines;
    private array $appendedLines;

    public function __construct(string $filePath)
    {
        if (!is_writable($file)) {
            throw new FileException(sprintf("'%s' isn't pointing to a writeable file!". $file));
        }
        $this->filePath = $filePath;
    }

    public function appendAfter(string|array $text, int $line)
    {
        $text = new Lines($text);

    }

    public function overwrite(string|array $text, int $from)
    {

    }

    public function save()
    {
        $file = new SplFileObject($this->filePath, "w+");
        $temp = $this->getTempCopy();

        $currentRealLine = 0;
        while(!$temp->eof())
        {
            $currentTempLine = $temp->key();
            $lineOffset = 0;

            if (isset($this->overWrittenLines[$currentTempLine])) {
                foreach ($this->overWrittenLines[$currentTempLine] as $overwrite) {

                }
            }  else {
                $file->fwrite($temp->current());
            }


            $currentRealLine += $lineOffset;
        }

    }

    private function overwriteInFile(array $lines): int
    {

    }

    private function appendToFile(array $lines, ): int
    {

    }

    private function getTempCopy(): SplTempFileObject
    {
        $tempFile = new SplTempFileObject();
        
        $file = new SplFileObject($this->filePath, "r");

        while(!$file->eof())
        {
            $tempFile->fwrite($file->current());
            $file->next();
            $tempFile->next();
        }
    
        return $tempFile;
    }

}