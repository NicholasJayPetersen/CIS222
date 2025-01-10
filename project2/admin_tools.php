<?php
class Tool extends Product{
    public function Add_Product(): bool
    {
        try {
            $conn = require('includes/db_conn.php');
            $SQL = "INSERT INTO Products (name, description, price, quantity, image, rating)
                VALUES (:name, :description, :price, :quantity, :image, :rating)";

            $stmt = $conn->prepare($SQL);
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':description', $this->description);
            $stmt->bindParam(':price', $this->price);
            $stmt->bindParam(':quantity', $this->quantity);
            $stmt->bindParam(':image', $this->image);
            $stmt->bindParam(':rating', $this->rating);
            $stmt->execute();
            return true;
        }
        catch (PDOException $e) {
            return false;
        }
    }

    public function Discontinue_Product(): bool
    {
        try {
            $conn = require('includes/db_conn.php');
            $SQL = "UPDATE Products 
                    SET Discontinued = 1
                    WHERE ProductID = :productID";

            $stmt = $conn->prepare($SQL);
            $stmt->bindParam(':productID', $this->productID);
            $stmt->execute();
            return true;
        }
        catch (PDOException $e) {
            return false;
        }
    }

    public function Reinstate_Product(): bool
    {
        try {
            $conn = require('includes/db_conn.php');
            $SQL = "UPDATE Products 
                    SET Discontinued = 0
                    WHERE ProductID = :productID";

            $stmt = $conn->prepare($SQL);
            $stmt->bindParam(':productID', $this->productID);
            $stmt->execute();
            return true;
        }
        catch (PDOException $e) {
            return false;
        }
    }

    public function Update_Name(): bool
    {
        try {
            $conn = require('includes/db_conn.php');
            $SQL = "UPDATE Products 
                    SET Name = :newName 
                    WHERE ProductID = :productID";

            $stmt = $conn->prepare($SQL);
            $stmt->bindParam(':newName', $this->name);
            $stmt->bindParam(':productID', $this->productID);
            $stmt->execute();
            return true;
        }
        catch (PDOException $e) {
            return false;
        }
    }

    public function Update_Image(): bool
    {
        try {
            $conn = require('includes/db_conn.php');
            $SQL = "UPDATE Products 
                    SET Image = :newImage 
                    WHERE ProductID = :productID";

            $stmt = $conn->prepare($SQL);
            $stmt->bindParam(':newImage', $this->image);
            $stmt->bindParam(':productID', $this->productID);
            $stmt->execute();
            return true;
        }
        catch (PDOException $e) {
            return false;
        }
    }

    public function Update_Description(): bool
    {
        try {
            $conn = require('includes/db_conn.php');
            $SQL = "UPDATE Products 
                    SET Description = :newDesc 
                    WHERE ProductID = :productID";

            $stmt = $conn->prepare($SQL);
            $stmt->bindParam(':newDesc', $this->description);
            $stmt->bindParam(':productID', $this->productID);
            $stmt->execute();
            return true;
        }
        catch (PDOException $e) {
            return false;
        }
    }

    public function Update_Price(): bool
    {
        try {
            $conn = require('includes/db_conn.php');
            $SQL = "UPDATE Products 
                    SET Price = :newPrice 
                    WHERE ProductID = :productID";

            $stmt = $conn->prepare($SQL);
            $stmt->bindParam(':newPrice', $this->price);
            $stmt->bindParam(':productID', $this->productID);
            $stmt->execute();
            return true;
        }
        catch (PDOException $e) {
            return false;
        }
    }

    public function Update_Quantity(): bool
    {
        try {
            $conn = require('includes/db_conn.php');
            $SQL = "UPDATE Products 
                    SET Quantity = :newQuantity 
                    WHERE ProductID = :productID";

            $stmt = $conn->prepare($SQL);
            $stmt->bindParam(':newQuantity', $this->quantity);
            $stmt->bindParam(':productID', $this->productID);
            $stmt->execute();
            return true;
        }
        catch (PDOException $e) {
            return false;
        }
    }

    public function Update_Rating(): bool
    {
        try {
            $conn = require('includes/db_conn.php');
            $SQL = "UPDATE Products 
                    SET Rating = :newRating 
                    WHERE ProductID = :productID";

            $stmt = $conn->prepare($SQL);
            $stmt->bindParam(':newRating', $this->rating);
            $stmt->bindParam(':productID', $this->productID);
            $stmt->execute();
            return true;
        }
        catch (PDOException $e) {
            return false;
        }
    }
}
