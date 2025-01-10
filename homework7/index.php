<!--
* @link https://cislinux.hfcc.edu/~njpetersen/homework7/index.php
* @author Nicholas Petersen
* @Date 2024-11-13
* @Category Assignments
* @Package Homework7
-->

<?php

//creates session and assigns default values if no session present
session_start();

if(!isset($_SESSION['username'])) {
    $_SESSION["username"] = "User";
    $_SESSION["date"] = "";
    $_SESSION["time"] = "";

}

//set cookie to determine users css choice
//default to light mode
if (!isset($_COOKIE["darkmode"])){
    setcookie("darkmode", "false");
    $darkmode = "false";
}

//set cookie to determine users font choice
//default to normal
if (!isset($_COOKIE["font-size"])){
    setcookie("font-size", "16px");
    $fontSize = "16px";
}
else{
    $fontSize = $_COOKIE["font-size"];
}


if(!isset($_COOKIE["favorite"])){
    setcookie("favorite", "black");
    $color = "";
}
else{
    $color = $_COOKIE["favorite"];
}

//if entire form is filled out set cookies and session variables
if (isset($_POST["username"]) && isset($_POST["font-size"]) && isset($_POST["favorite"])){
    $_SESSION["username"] = $_POST["username"];
    $_SESSION["date"] = date("m/d/Y");
    $_SESSION["time"] = date("H:i:s");
    setcookie("font-size", $_POST["font-size"]);
    setcookie("favorite", $_POST["favorite"]);

    $color = $_POST["favorite"];
    $fontSize = $_POST["font-size"];

}

$username = $_SESSION["username"];
$date = $_SESSION["date"];
$time = $_SESSION["time"];

?>

<!DocType html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link id="style" rel="stylesheet" href="
            <?php
            //checks the cookie to see what the last set mode was and sets the stylesheet to that
                if((!isset($_COOKIE["darkmode"]) || $_COOKIE["darkmode"] == "false"))
                    {echo "bootstrap-light.css";}
                elseif($_COOKIE["darkmode"] == "true")
                    {echo "bootstrap-dark.css";}
                else
                    {echo "bootstrap-light.css";}
            ?>"
        >
        <link rel="stylesheet" href="w3-slider.css">
        <title>Homework 7</title>
    </head>

    <body
            <?php
            //if username is not default send the welcome alert
                if($_SESSION["username"] != "User")
                    {echo 'onload="welcomeMessage()"';}
                else
                    {echo "";}
            ?>
    >
        <h1>Fun with Cookies and Sessions</h1>
        <br>
        <br>
        <h3>Set your cookies and session items:</h3>
        <form method="post" action="#">

            <label for="darkmode" class="switch">
                <label id="dark-mode-label" for="darkmode">Dark Mode:</label>
                <input type="checkbox" name="darkmode" id="darkmode" onclick="darkMode()"
                    <?php
                    //determines the status of the checkbox on page load
                        if(isset($_COOKIE["darkmode"]) && $_COOKIE["darkmode"] == "true")
                            {echo "checked";}
                        else
                            {echo "";}
                    ?>
                >
                <span class="slider round"></span>
            </label>

            <br>
            <label for="username">Username: </label>
            <input type="text" id="username" name="username" placeholder="Username" required>

            <br><br>

            <div class="font-box" id="font-box">
                <label for="font-box">Font size: &ensp;</label>
                <input type="radio" id="regular" name="font-size" value="16px" checked>
                <label for="regular">Regular</label>&ensp;
                <input type="radio" id="large" name="font-size" value="20px">
                <label for="large">Large</label>
            </div>

            <br><br>

            <label for = "favorite">Favorite Color: </label>
            <input type="text" id="favorite" name="favorite" placeholder="Favorite color" required>
            <br><br>
            <button type="submit">Log in</button>
        </form>

        <script>
            let fontColor = "<?php echo $color ;?>";
            document.body.style.color = fontColor;
            console.log("Font color: " + fontColor);

            let fontSize = "<?php echo $fontSize ;?>";
            document.body.style.fontSize = fontSize;
            console.log("Font size: " + fontSize);

            function welcomeMessage(){
                alert("Hello <?php echo $username; ?>. You logged in on <?php echo $date;?> at <?php echo $time;?>.");
            }

            function darkMode() {
                let slider = document.getElementById("darkmode");
                let stylesheet = document.getElementById("style");

                //turns on darkmode and updates cookie dynamically
                if (slider.checked === true){
                    stylesheet.href = "bootstrap-dark.css";
                    document.cookie = "darkmode=true";
                }
                //turns off darkmode and updates cookie dynamically
                else {
                    stylesheet.href = "bootstrap-light.css";
                    document.cookie = "darkmode=false";
                }
            }
        </script>

    </body>
</html>
