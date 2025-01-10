<?php session_start(); ?>
<header>
    <div class="logo">
        <a href="index.php"><img src="./images/logo.png" alt="logo"></a>
    </div>
    <div class="navbar">
        <ul class="header-link">

            <?php
                    if (isset($_SESSION['IsAdmin']) && $_SESSION['IsAdmin'] == 1) {
                        echo "<li id='header-link'><a href='./admin.php'>Admin</a></li>";
                    }
                    echo "  <li id='header-link'><a href='./index.php'>Home</a></li>
                            <li id='header-link'><a href = './catalog.php'>Catalog</a></li>
                            <li id='header-link'><a href='./contact.php'>Contact</a></li>";

                            if(!isset($_SESSION['first']) && !isset($_SESSION['last'])) {
                                $_SESSION['first'] = "";
                                $_SESSION['last'] = "Guest";
                            }
                            if($_SESSION['last'] == "Guest"){
                                echo "<li id='header-link'><a href='./login.php'>Login</a></li>";
                            }
                            else
                                echo "<li id='header-link'><a href='./logout.php'>Logout</a></li>";

                    echo "  <li id='account-name'>Welcome, " . $_SESSION['first'] . " " . $_SESSION['last'] . "</a></li>
                            <li id='cart-icon'><a href='./cart.php'><img src='./images/cart-icon-small.png' alt='cart-icon'></a></li>
                        ";

            ?>
        </ul>
    </div>
</header>
