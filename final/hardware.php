<?php
class Hardware {
private $hardware_id;
private $hardware_name;
private$hardware_description;
private $hardware_make;
private $hardware_model;
private $hardware_date;

public function __construct(string $name = '', string $description ='', string $make = '', string $model = '', string $date = '')
{
    $this->hardware_id = null;
    $this->hardware_name = $name;
    $this->hardware_description = $description;
    $this->hardware_make = $make;
    $this->hardware_model = $model;
    $this->hardware_date = $date;

}

public function insertHardware(): bool{
    include("../creds.php");
    try{
        $conn = new PDO('mysql:host=localhost;dbname='. DBASE, UNAME, PASS);
        $sql = "INSERT INTO Hardware(
                     hardware_name,
                     hardware_description,
                     hardware_make,
                     hardware_model,
                     hardware_date)
                Values (:hardware_name, 
                        :hardware_description, 
                        :hardware_make,
                        :hardware_model,
                        :hardware_date);";

        $statement = $conn->prepare($sql);
        $statement->bindValue(":hardware_name", $this->hardware_name);
        $statement->bindValue(":hardware_description", $this->hardware_description);
        $statement->bindValue(":hardware_make", $this->hardware_make);
        $statement->bindValue(":hardware_model", $this->hardware_model);
        $statement->bindValue(":hardware_date", $this->hardware_date);
        $statement->execute();
        return true;
    }
    catch (PDOException $e){
        $conn = null;
        return false;
    }
}

public function getHardwareDevices(int $sort = 1): array {
    switch ($sort) {
        case 1:
            $sort = "hardware_name ASC";
            break;
        case 2:
            $sort = "hardware_name DESC";
            break;
        case 3:
            $sort = "hardware_date ASC";
            break;
        case 4:
            $sort = "hardware_date DESC";
            break;
        default:
            $sort = "hardware_name DESC";
            break;

    }
    include("../creds.php");
    try{
        $conn = new PDO('mysql:host=localhost;dbname='. DBASE, UNAME, PASS);
        $sql = "SELECT * FROM Hardware ORDER BY " . "$sort";
        $statement = $conn->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PDOException $e){
        $conn = null;
        return [];
    }
}

}