<?php
/**
 * q2.txt
 *
 * @category   Quiz
 * @package    Quiz 2
 * @author     Nicholas Petersen <njpetersen@hawkmail.hfcc.edu>
 * @version    2024.09.12
 * @grade      9 / 10
 */

// 2 pts
// 1. Below I have two variable strings setup inside a PHP file.
// Write any additional code needed to append the strings together and output their contents.
$name = "Keanu Reeves";
$sentence = " is my favorite actor.";

//Concatenation to join the strings using the . operator and added a space in between
echo ($name . " " . $sentence);


// 3 pts
// Write an echo statement using the concatenation operator to send output to the browser.
// Once complete, the data sent to the browser should look exactly like this with the p tags.
// <p>The Keanu Reeves</p>
$name = "Keanu Reeves";

echo ("<p>The " . $name . "</p>");

// 1/2 pts
// 3. Define a constant called MOVIE_TITLE and set it to the following string. "Dr. Strange"
define(MOVIE_TITLE, "Dr. Strange");

// 3 pts
// 4. Define an array called $classes
// Populate the array with a few strings containing classes you have taken at HFC. Ex. "CIS-222"
// Then use a foreach loop to iterate through that array and echo the class strings.

$classes = ["CIS-122", "CIS-125", "CIS-111", "CIS-129", "CIS-130", "CIS-222"];

foreach ($classes as $course) {
    echo $course . "<br>";
}