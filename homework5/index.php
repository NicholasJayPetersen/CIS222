<!--
* @link https://cislinux.hfcc.edu/~njpetersen/homework5/index.php
* @author Nicholas Petersen
* @Date 2024-10-21
* @Category Assignments
* @Package Homework 5
-->

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width initial-scale=1.0">
        <title>Homework 5</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>

    <h1>Homework 5: Classes</h1>

        <?php

        require("MyBaseObject.php");
        require("MyFileObject.php");

        //create file object with minimal params
        $file = new MyFileObject("TestFile.txt", "text");

        //var_export initial properties
        echo"<div>
                <h2>var_export()</h2>
                <h4>Show object before changes</h4>
                <pre>
               ";
        var_export($file);
        echo "</pre></div>";

        //change the type property
        echo"<div>
                <h2>SetType() & GetType()</h2>
                <h4>Set and show the filetype</h4>";
        $file->SetType("ASCII-Text");
        echo"<br>";
        var_dump($file->GetType());
        echo"</div>";

        //get date created timestamp
        echo"<div>
                <h2>GetCreated()</h2>
                <h4>Shows when the file was made</h4>";
        echo "Date Created: ".$file->GetCreated()."<br>";

        //modify the created date
        $file->SetCreated(new DateTime("yesterday 3PM", new DateTimeZone("America/Detroit")));
        echo"</div>";

        //set content of the file
        echo"<div>
                <h2>SetContent() & GetContent()</h2>
                <h4>Getters and setters to modify and show the content property</h4>";
        $file->SetContent("This is a test file.");
        echo "<br>This is a getter that shows the file contents: " .$file->GetContent();
        echo"</div>";

        //set file name to something else
        echo"<div>
                <h2>SetFilename()</h2>
                <h4>Updates the filename</h4>";
        $file->SetFilename("NewName.txt");
        echo "<br>New Filename is: " .$file->GetFilename();
        echo"</div>";

        //function to save file to disk
        echo"<div>
                <h2>SaveFile() & GetCreated()</h2>
                <h4>Saves to disk  and updates created time</h4>";
        $file->SaveFile();
        echo"<br>";
        $file->SetCreated(new DateTime("now", new DateTimeZone("America/Detroit")));
        echo "<br><br>File Created on: ".$file->GetCreated();
        echo"</div>";

        //function to load file from disk
        echo"<div>
                <h2>LoadFile() & GetContent()</h2>
                <h4>Loads file from disk into content property and gets it</h4>";
        $file->LoadFile("TestFile.txt");
        echo "<br>Content: ".$file->GetContent() . "<br><br>";
        echo"</div>";

        //function to append to the end of the file
        echo"<div>
                <h2>SetContent() & AppendFile()</h2>
                <h4>Changes content property and appends to end of file</h4>";
        $file->SetContent("This is the second sentence in the test file.");
        echo"<br><br>";
        $file->AppendFile();
        echo"</div>";

        //function to load file contents and echo it out
        echo"<div>
                <h2>LoadFile() & GetContent()</h2>
                <h4>Load newly appended file to content property and get the contents</h4>";
        $file->LoadFile("TestFile.txt");
        echo "<br>Content: ".$file->GetContent();
        echo"</div>";

        //final vardump to see modified properties
        echo"<div>
                <h2>var_export()</h2>
                <h4>Show object after changes</h4>";
        echo"<pre>";
        var_export($file);
        echo "</pre>";
        echo"</div>";

        ?>
    </body>
</html>