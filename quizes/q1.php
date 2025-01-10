
<?php
/**
 * q1.txt
 *
 * Quiz 1 regarding basic HTML, CSS, and PHP
 *
 * @category   Quiz
 * @package    Quiz 1
 * @author     Chad Banks <crbanks1@hfcc.edu>
 * @version    2024.09.05
 * @link       X
 */
?>


// 3 pts
// 1. Show me a basic HTML 5 page below.

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Nicholas Petersen - HW1</title>
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
        <p>Hello World!</p>
    </body>
</html>

// 2 pts
// 2. Add a link tag to the HTML page above, and name the file style.css
// (this style.css file does not need to really exist for this quiz)

<link rel="stylesheet" href="style.css"> added inside head tag above.

// 4 pts
// 3. Open a PHP tag and create a variable named myVar and assign a string into it.

<?php
$myVar = "This is a variable with a string!";
?>

// 1 pt
// 5. Define inheritance in your own words.

<p>Inheritance is the parent passing down certain properties to its child.
    This could be permissions in a directory for example. Say you have a directory called "Dad" with a
    permission setting of 755. Then you create a new directory inside it called "Son" The new folder
    called "Son" inside of "dad" will also have a permission setting of 755 because it INHERITS those properties
    from the parent. In PHP this same principle would apply to something like different classes and objects. A child
    class will inherit the properties of its parent class.</p>
