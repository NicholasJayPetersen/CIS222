<?php session_start(); ?>
<!--
* @link https://cislinux.hfcc.edu/~njpetersen/homework9/posts.php
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
    <title>Posts</title>
</head>

<body>
    <div class="container">
        <div class="row">
        <?php

        //for when new post button is clicked
        if(isset($_POST['new-post']) && $_POST['postID'] = "1") {
            echo '<h1>New Post</h1>';
            echo '<form method="post" action="threads.php">
                   <div class="row">
                        <div class="col">
                            <textarea name="title" cols="80" rows="1" placeholder="Title" required></textarea>
                        </div>
                   </div>
                   <div class="row">&nbsp;</div>
                    <div class="row">
                        <div class="col">
                            <textarea name="content" cols="80" rows="5" placeholder="Content" required></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-outline-primary">Post</button>
                        </div>
                        <div class="col">&nbsp;</div>
                    </div>
                  </form>';
        }

        //for when a post is selected, not new post
        if(!isset($_POST['new-post']) || $_POST['new-post'] != "1"){
            //get selected post from index page
            if(isset($_POST['postID']) && $_POST['postID'] != "") {
                $_SESSION['postID'] = $_POST['postID'];
            }

            //use postID to get the title and content of the post
            $conn = require_once '../db_conn.php';
            $sql = "SELECT Title, Content, Username
                FROM Posts
                WHERE PostID = :postID";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':postID', $_SESSION['postID']);
            $stmt->execute();
            $post = $stmt->fetch(PDO::FETCH_ASSOC);

            //then get the comments
            $sql = "SELECT Comment, Username
                FROM Comments
                WHERE PostID = :postID";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':postID', $_SESSION['postID']);
            $stmt->execute();
            $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

            //echo out the post and the content
            echo "<h1>Message Boards</h1>
                  <div class='row'>&nbsp;</div>
                  <div class='row'>
                     <div class='col'>
                        <h3>$post[Title]</h3>
                        <p id='content'>" . $post['Username'] . ":<br>" . $post['Content'] . "</p>
                     </div>
                  </div>";

            // echo out each comment for that post underneath the post
            echo "<div class='row'>
             <div class='col'>";
            foreach ($comments as $comment) {
                echo"  <p id='comment'>" . $comment['Username'] . ": " . $comment['Comment'] . "</p>";
            }
            echo"</div>
            </div>";

            echo '<div class="row">
                <form action="threads.php" method="post">
                    <label for="comment">Comment:</label>
                    <br>
                    <textarea rows="3" cols="80" id="comment" name="comment" required></textarea>
                    <div class="col">
                        <button type="submit" class="btn btn-outline-primary">Add comment</button>
                    </div>
                </form>
                <div class="col"></div>
                <div class="col">
                    <button onClick="window.location.href=\'index.php\'" class="btn btn-outline-primary">Back</button>
                </div>
            </div>';
        }
        ?>

        </div>
    </div>
</body>
</html>