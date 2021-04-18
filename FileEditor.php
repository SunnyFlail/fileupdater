<?php

namespace SunnyFlail\FileEditor;

use \SplFileObject;
use \SplTempFileObject;

final class FileEditor
{
    public const APPEND_CASCADING = 000;

    private string $filePath;
    private array $toOverwrite;
    private array $toAppend;

    public function __construct(string $filePath)
    {
        if (!is_writable($filePath)) {
            throw new FileException(sprintf("'%s' isn't pointing to a writeable file!", $filePath));
        }
        $this->filePath = $filePath;
        $this->toOverwrite = [];
        $this->toAppend = [];
    }

    public function appendAfter(string|array $text, int $startLine)
    {
        if ($startLine < 1) {
            throw new FileException(sprintf("Line number must be positive!"));
        }

        //Convert line number to SplFileObject index
        #$startLine --;
        $startLine -= 1;

        if (!isset($this->toAppend[$startLine])) {
            $this->toAppend[$startLine] = new AppendedLines($startLine); 
        }
        $this->toAppend[$startLine]->append($text);       
    }

    public function overwrite(string|array $text, int $startLine, int $endLine)
    {
        if ($startLine < 1 || $endLine < 1) {
            throw new FileException(sprintf("Line number must be positive!"));
        }

        //Convert line number to SplFileObject index
        $startLine -= 1;
        $endLine -= 1;

        if (!isset($this->toOverwrite[$startLine])) {
            $this->toOverwrite[$startLine] = new OverwrittenLines($startLine, $endLine); 
        }
        $this->toOverwrite[$startLine]->append($text);      
    }

    /**
    * Persists changes to file 
    */
    public function save(int $mode = self::APPEND_CASCADING)
    {
        $temp = $this->getTempCopy();

        $file = new SplFileObject($this->filePath, "w");

        switch ($mode) {
            case self::APPEND_CASCADING:
                return $this->cascading($temp, $file);
            default:
                throw new FileException(sprintf("Unknown mode code '%s' !", $mode));
        }
    }

    private function cascading(SplTempFileObject $tempFile, SplFileObject $file)
    {
        while (!$tempFile->eof()) {

            // Current line in $tempFile
            $currentLine = $tempFile->key();

            $offset = 1;

            if (isset($this->toOverwrite[$currentLine])) {
                $overwrite = &$this->toOverwrite[$currentLine];
                $file->fwrite($overwrite.PHP_EOL);
                $offset = $overwrite->getAffectedCount();
            }  else {
                $current = $tempFile->current();
                $file->fwrite($current);
            }

            if (isset($this->toAppend[$currentLine])) {
                $append = &$this->toAppend[$currentLine];
                $file->fwrite($append.PHP_EOL);
            }

            $tempFile->seek($currentLine + $offset);
        }


        $this->toOverwrite = [];
        $this->toAppend = [];
    }
    
    private function getTempCopy(): SplTempFileObject
    {
        $tempFile = new SplTempFileObject();
        
        $content = file_get_contents($this->filePath);

        $tempFile->fwrite($content);
        $tempFile->rewind();

        return $tempFile;
    }

}