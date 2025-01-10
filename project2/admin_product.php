<?php

class Product{
    protected int $productID;
    protected string $name;
    protected string $description;
    protected float $price;
    protected int $quantity;
    protected string $image;
    protected int $rating;


    function __construct(...$args){
        if (count($args) === 1 && is_int($args[0]))
        {
            $this->Construct_Discontinue($args[0]);
        }
        elseif (count($args) >= 4 && is_string($args[0]) && is_string($args[1]) && is_float($args[2]) && is_int($args[3]))
        {
            $this->Construct_Add_Update(...$args);
        }
        else
        {
            throw new InvalidArgumentException("Invalid constructor arguments provided.");
        }
    }

    function Construct_Add_Update(string $name, string $description, float $price, int $quantity, string $image= '', int $rating = 0, $productID=null): void
    {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->image = $image;
        $this->rating = $rating;
        if($productID !== null)
            $this->productID = $productID;

    }

    function Construct_Discontinue(int $productID): void
    {
        $this->productID = $productID;
        try {
            $conn = require('includes/db_conn.php');
            $SQL = "SELECT * 
                    FROM Products 
                    WHERE ProductID = :productID";

            $stmt = $conn->prepare($SQL);
            $stmt->bindParam(':productID', $this->productID);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->productID = $result["ProductID"];
            $this->name = $result["Name"];
            $this->description = $result["Description"];
            $this->price = $result["Price"];
            $this->quantity = $result["Quantity"];
            $this->image = $result["Image"];
            $this->rating = $result["Rating"];
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getProductID(): int{
        return $this->productID;
    }
    public function getName(): string{
        return $this->name;
    }
    public function getDescription(): string{
        return $this->description;
    }
    public function getPrice(): float{
        return $this->price;
    }
    public function getQuantity(): int{
        return $this->quantity;
    }
    public function getImage(): string{
        return $this->image;
    }
    public function getRating(): int{
        return $this->rating;
    }

    public function setName(string $name): void{
        $this->name = $name;
    }
    public function setDescription(string $description): void{
        $this->description = $description;
    }
    public function setPrice(float $price): void{
        $this->price = $price;
    }
    public function setQuantity(int $quantity): void{
        $this->quantity = $quantity;
    }
    public function setImage(string $image): void{
        $this->image = $image;
    }
    public function setRating(int $rating): void{
        $this->rating = $rating;
    }


}

