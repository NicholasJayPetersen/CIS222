<?php

class MyFileObject extends MyBaseObject{

    //create filename property
    private string $filename;

    //create constructor referencing parent constructor
    function __construct(string $filename, string $type){
        parent::__construct($type);
        $this->filename = $filename;
    }
    //getter for filename
    function getFilename(): string{
        return $this->filename;
    }
    //setter for filename
    function setFilename(string $filename): void{
        $this->filename = $filename;
    }

    function SaveFile (): void{
        file_put_contents($this->filename, $this->content);
        echo "File Saved as: $this->filename\n";
    }
    function AppendFile(): void{
        file_put_contents($this->filename, $this->content, FILE_APPEND);
        echo "Content append to end of file: $this->filename\n";
    }
    function LoadFile (string $filename): void{
        $this->content = file_get_contents($filename);
        echo "File loaded into contents property: $this->filename";
    }
}

