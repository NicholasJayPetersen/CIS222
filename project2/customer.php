<?php
class Customer{
    protected string $first;
    protected string $last;
    protected string $email;
    protected string $birthday;
    protected int $countryCode;
    protected int $phone1;
    protected int $phone2;
    protected int $phone3;
    protected string $street;
    protected string $city;
    protected string $state;
    protected int $zip;
    protected string $country;
    protected int $customerID;

    function __construct(string $first, string $last, string $email, string $birthday, int $countryCode, int $phone1, int $phone2, int $phone3, string $street, string $city, string $state, int $zip, string $country, $CustomerID = null)
    {
        $this->first = $first;
        $this->last = $last;
        $this->email = $email;
        $this->birthday = $birthday;
        $this->countryCode = $countryCode;
        $this->phone1 = $phone1;
        $this->phone2 = $phone2;
        $this->phone3 = $phone3;
        $this->street = $street;
        $this->city = $city;
        $this->state = $state;
        $this->zip = $zip;
        $this->country = $country;
        if ($CustomerID != null) {
            $this->customerID = $CustomerID;
        }
        else{
            $this->customerID = -1;
        }
}
    function getFirst(): string{
        return $this->first;
    }
    function getLast(): string{
        return $this->last;
    }
    function getEmail(): string{
        return $this->email;
    }
    function getBirthday(): string{
        return $this->birthday;
    }
    function getCountryCode(): int{
        return $this->countryCode;
    }
    function getPhone1(): int{
        return $this->phone1;
    }
    function getPhone2(): int{
        return $this->phone2;
    }
    function getPhone3(): int{
        return $this->phone3;
    }
    function getStreet(): string{
        return $this->street;
    }
    function getCity(): string{
        return $this->city;
    }
    function getState(): string{
        return $this->state;
    }
    function getZip(): int{
        return $this->zip;
    }
    function getCountry(): string{
        return $this->country;
    }
    function setFirst(string $first): void{
        $this->first = $first;
    }
    function setLast(string $last): void{
        $this->last = $last;
    }
    function setEmail(string $email): void{
        $this->email = $email;
    }
    function setBirthday(string $birthday): void{
        $this->birthday = $birthday;
    }
    function setCountryCode(int $countryCode): void{
        $this->countryCode = $countryCode;
    }
    function setPhone1(int $phone1): void{
        $this->phone1 = $phone1;
    }
    function setPhone2(int $phone2): void{
        $this->phone2 = $phone2;
    }
    function setPhone3(int $phone3): void{
        $this->phone3 = $phone3;
    }
    function setStreet(string $street): void
    {
        $this->street = $street;
    }
    function setCity(string $city): void{
        $this->city = $city;
    }
    function setState(string $state): void{
        $this->state = $state;
    }
    function setZip(int $zip): void{
        $this->zip = $zip;
    }
    function setCountry(string $country): void{
        $this->country = $country;
    }
    function add_customer(): bool {
        try {
            //insert customer into table
            $conn = require('includes/db_conn.php');
            $SQL = "INSERT INTO Customers(First, Last, Email, Birthday, CountryCode, Phone1, Phone2, Phone3, Street, City, State, Zip, Country) 
                    VALUES(:first, :last, :email, :birthday, :countryCode, :phone1, :phone2, :phone3, :street, :city, :state, :zip, :country)";
            $stmt = $conn->prepare($SQL);
            $stmt->bindParam(':first', $this->first);
            $stmt->bindParam(':last', $this->last);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':birthday', $this->birthday);
            $stmt->bindParam(':countryCode', $this->country);
            $stmt->bindParam(':phone1', $this->phone1);
            $stmt->bindParam(':phone2', $this->phone2);
            $stmt->bindParam(':phone3', $this->phone3);
            $stmt->bindParam(':street', $this->street);
            $stmt->bindParam(':city', $this->city);
            $stmt->bindParam(':state', $this->state);
            $stmt->bindParam(':zip', $this->zip);
            $stmt->bindParam(':country', $this->country);
            $stmt->execute();
            return true;
        }
        catch (PDOException $e) {
            return false;
        }
    }

    function fetch_CustomerID(){
        if($this->customerID != -1){
            return $this->customerID;
        }
        else{
            try{
                $conn = require('includes/db_conn.php');
                $SQL = "SELECT CustomerID 
                        FROM Customers
                        WHERE Email = :email";
                $stmt = $conn->prepare($SQL);
                $stmt->bindParam(':email', $this->email);
                $stmt->execute();
                $ID = $stmt->fetch();

                $this->customerID = $ID[0];
                return $this->customerID;
            }
            catch(PDOException $e){
                return -1;
            }
        }
    }
}


