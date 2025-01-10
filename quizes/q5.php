<?php
/**
 * q5.txt
 *
 * Quiz 5 Objects!
 *
 * @category    OOP
 * @package     Quiz 5
 * @author      Nicholas Petersen <njpetersen@hawkmail.hfcc.edu>
 * @version     2024.10.24
 * @grade       11 / 10
 */

// 1. (4pts) Define a simple class called Order.
// Your class should have a standard construct function, but it doesn't need to do anything yet.
// It should also have at least 3 private properties, one being order_id

class Order {

    private int $order_id;
    private float $order_total;
    private string $order_status;

    public function __construct(int $order_id)
    {
        $this->order_id = $order_id;
    }


    public function getOrderId(): int{
        return $this->order_id;
    }
    public function setOrderId(int $order_id){
        $this->order_id = $order_id;
    }

}



// 2. (4pts) Add a get and set function for one of your Object class properties above (order_id recommended).
// Hint: A get function returns a property, a set function saves data into it.

            //above code lines 30 and 33

// 3. (1pt) Update the Order constructor to accept an $orderId parameter and set its order_id property to it.

            //above code line 24

// 4. (1pt) In a $myTransaction variable, create a new instance of the class you just created above.

$order_number = 1;
$myTransaction = new Order($order_number);



// B. (1pt) Assuming all Order properties are public, set the order_id of the $myTransaction variable to 17.

$myTransaction->setOrderId(17);