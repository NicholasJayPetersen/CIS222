<?php

//create an object class
class MyBaseObject {

    //define properties of the class
    protected string $content;
    private DateTime $created;
    private string $type;

    //constructor method for object
    function __construct(string $type){
        $this->type = $type;
        $this->created = new DateTime('now' , new DateTimeZone('America/Detroit'));
    }

    //getter for content property
    function GetContent() :string{
        return $this->content;
    }
    //setter for content property
    function SetContent($content) :void{
        $this -> content = $content;
        echo "Content has been updated to: \n".$content;
    }
    //getter for date property
    function GetCreated() :string {
        return date_format($this->created, 'Y-m-d H:i:s');
    }
    //setter for date property
    function SetCreated(DateTime $created) :void{
        $this->created = $created;
        echo "Date created has been updated to: ". date_format($created, 'Y-m-d H:i:s');
    }
    //getter for type property
    function GetType() :string {
        return $this->type;
    }
    //setter for type property
    function SetType(string $type):void{
        $this->type = $type;
        echo "Type has been updated to: ".$type;
    }
}
