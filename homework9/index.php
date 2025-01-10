<?php session_start(); ?>
<!--
* @link https://cislinux.hfcc.edu/~njpetersen/homework9/index.php
* @author Nicholas Petersen
* @Date 2024-12-8
* @Category Assignments
* @Package Homework9
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="styles.css">
    <title>Message Boards</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <h1>Message Boards</h1>
            <br>
                <table>
                    <tbody>
                        <?php
                        $_SESSION['username'] = session_id();

                        $conn = require_once '../db_conn.php';
                        $sql = "SELECT * FROM Posts";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        $result = $stmt->fetchAll();


                        foreach ($result as $post) {
                            echo "<tr>
                        <form action='posts.php' method='POST'>
                            <input type='hidden' name='postID' value='" . $post['PostID'] . "'>
                            <button type='submit' class='btn btn-outline-primary'> " . $post['Title'] . "</button>
                        </form>
                        <br>
                      </tr>";
                        }
                        ?>
                    </tbody>
                </table>
        </div>
        <br>
        <div class="row">
            <div class="col"></div>
            <div class="col-2">
                <form action="posts.php" method="post">
                    <input type='hidden' name='new-post' value='1' >
                    <button type="submit" class="btn btn-outline-primary">New post</button>
                </form>
            </div>
            </div>
        </div>
    </div>
</body>
</html>
