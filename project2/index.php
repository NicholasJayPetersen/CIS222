<?php session_start(); ?>
<!--
* @link https://cislinux.hfcc.edu/~njpetersen/project2/index.php
* @author Nicholas Petersen
* @Date 2024-10-08
* @Category Projects
* @Package Project2_Index
*
* ADMIN CREDS:
    Username: admin
    Password: password123
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>Digital Art</title>
</head>
    <body>
    <?php include_once ("./includes/header.php"); ?>

        <div class="container">
                <div class="main-content">
                    <?php
                    if(isset($_GET['logout']) && $_GET['logout']==1){ echo '<button class="btn btn-success fade-out" id="big-button">Logout successful.</button>'; }
                    ?>
                    <!-- Slideshow container -->
                    <div class="slideshow-container">
                        <!-- Full-width images with number and caption text -->
                        <div class="mySlides fade">
                            <div class="numbertext"></div>
                                <div class="slideshow-image">
                                    <h1>Welcome to the digital art store!</h1>
                                    <h3>Come browse our wares</h3>
                                    <br><br>
                                    <form action="catalog.php"><button type="submit">Catalog</button></form>
                                </div>
                            <div class="text"> </div>
                        </div>

                        <div class="mySlides fade">
                            <div class="numbertext"></div>
                            <div class="slideshow-image">
                                <h1>New Products</h1>
                                <br>
                                <div class="slideshow-new-products">
                                    <img alt="product image" src="images/abstract1.webp">
                                    <img alt="product image" src="images/cityscape1.webp">
                                    <img alt="product image" src="images/cosmicScene1.webp">
                                </div>
                                <br>
                                <form action="catalog.php"><button type="submit">Shop Now</button> </form>
                            </div>
                            <div class="text"> </div>
                        </div>

                        <div class="mySlides fade">
                            <div class="numbertext"></div>
                            <div class ="slideshow-image">
                                <h1>Questions or Suggestions?</h1>
                                <h3>Let us know!</h3>
                                <br><br>
                                <form action="contact.php"><button type="submit">Contact Us</button></form>
                            </div>
                            <div class="text"> </div>
                        </div>

                        <!-- Next and previous buttons -->
                        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                        <a class="next" onclick="plusSlides(1)">&#10095;</a>
                        <br>
                    </div>
                    <!-- The dots/circles -->
                        <div class="dots">
                            <span class="dot" onclick="currentSlide(1)"></span>
                            <span class="dot" onclick="currentSlide(2)"></span>
                            <span class="dot" onclick="currentSlide(3)"></span>
                        </div>
                </div>
        </div>
    <?php include_once("./includes/footer.php"); ?>
    <script src="js/slideshow.js"></script>
    </body>
</html>