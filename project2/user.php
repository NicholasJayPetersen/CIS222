<?php
class User{
    private string $uname;
    private string $password;

    private int $CustomerID;

    function __construct(int $CustomerID, string $uname, string $password){
        $this->CustomerID = $CustomerID;
        $this->uname = $uname;
        $this->password = $password;
    }

    function getCustomerID() : int {
        return $this->CustomerID;
    }
    function getUsername(){
        return $this->uname;
    }
    function getPassword(){
        return $this->password;
    }
    function setUsername($username){
        $this->uname = $username;
    }
    function setPassword($password){
        $this->password = $password;
    }

    function addUser(): bool
    {
        try {
            //insert username and customer ID into users table
            $conn = require('includes/db_conn.php');
            $SQL = "INSERT INTO Users(Uname, CustomerID)
                    VALUES(:uname, :customerID )";
            $stmt = $conn->prepare($SQL);
            $stmt->bindParam(':uname', $this->uname);
            $stmt->bindParam(':customerID', $this->CustomerID);
            $stmt->execute();

            $SQL = "INSERT INTO Pass(PW, Uname)
                    VALUES(:password, :username)";
            $stmt = $conn->prepare($SQL);
            $stmt->bindParam(':password', $this->password);
            $stmt->bindParam(':username', $this->uname);
            $stmt->execute();
            return true;
    }
        catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    function ChangePassword(): bool{
        try {
            $conn = require('includes/db_conn.php');
            $SQL = "UPDATE Pass 
                    SET PW = :password 
                    WHERE Uname = :uname";
            $stmt = $conn->prepare($SQL);
            $stmt->bindParam(':uname', $this->uname);
            $stmt->bindParam(':password', $this->password);
            $stmt->execute();
            return true;
        }
        catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }
}