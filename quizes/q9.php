<?php
/**
 * q9X.txt
 *
 * Quiz 9 & 10
 *
 * @category    Cumulative
 * @package     Quiz
 * @author      Nicholas Petersen <njpetersen@hawkmail.hfcc.edu>
 * @version     2024.12.05
 * @grade       ? / 20
 */

// 1. (6pts) Create a class below called DatabaseManager.
//              On construct this class should create a database connection.
//              It should also store this connection in a private property named connection.

class DatabaseManager{
    private string $password;
    private PDO $connection;

    function __construct(string $password = ""){
        $this->password = $password;
        $this->connection = new PDO("mysql:host=localhost;dbname=hfc", "user", "password");
    }


// 2. (6pts) Create a method for the class above that can accept a string parameter, hash it, then return it.
// 3. (4pts) Add a try/catch to the hashing method from question 2. If caught, throw a new exception.

    function hash_password(): string{
        try{
            if($this->password != ""){
                return hash("sha256", $this->password);
            }
            else{
                throw new Exception("Password not provided");
            }
        }
        catch(Exception $e){
            return $e->getMessage();
        }
    }
}
// 4. (4pts) Let's say you have a password saved in the $pass variable.
//              But we do not assume this is true!
//              Execute some checks to ensure the variable is not null, is indeed a string, and is longer than 7 characters.
$pass = 'ThisIsNotARealPasswordIsIt?';

if(!empty($pass) && is_string($pass) && strlen($pass) > 7){
    echo "password is longer than 7 characters";
}


// B. (2pts) Use the hashing method you created above to hash the $pass variable.
//              Then save the hashed password in an $encp variable.

$password_maker = new DatabaseManager($pass);
$encp = $password_maker->hash_password();

