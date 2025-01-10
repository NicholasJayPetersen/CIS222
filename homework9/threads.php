<?php session_start(); ?>
<!--
* @link https://cislinux.hfcc.edu/~njpetersen/homework9/threads.php
* @author Nicholas Petersen
* @Date 2024-12-8
* @Category Assignments
* @Package Homework9
-->

<?php

$success = 0;
$username = $_SESSION['username'];

// if new post, insert into Posts table
if(isset($_POST['title'])  && $_POST['title'] != "" && isset($_POST['content']) && $_POST['content'] != ""){
    try {
        $title = strip_tags($_POST['title']);
        $content = strip_tags($_POST['content']);

        $conn = require_once('../db_conn.php');
        $sql = "INSERT INTO Posts (Username, Title, Content)
            VALUES (:Username, :Title, :Content);";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':Username', $username);
        $stmt->bindParam(':Title', $title);
        $stmt->bindParam(':Content', $content);
        $stmt->execute();
        $success = 1;

        //set selected post to new post
        $_SESSION['postID'] = $conn->lastInsertId();
    }
    catch (PDOException $e) {
        echo $e->getMessage();
    }
}

//if comment on existing, insert into Comments table
if (isset($_POST['comment']) && ($_POST['comment'] != "")) {
    try {
        $comment = strip_tags($_POST["comment"]);
        $postID = $_SESSION['postID'];

        $conn = require_once('../db_conn.php');
        $sql = "INSERT INTO Comments (Username, Comment, PostID)
            VALUES (:Username, :Comment, :PostID);";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':Username', $username);
        $stmt->bindParam(':Comment', $comment);
        $stmt->bindParam(':PostID', $postID);
        $stmt->execute();
        $success = 1;

    }
    catch (PDOException $e) {
        echo $e->getMessage();
    }
}

if ($success == 1) {
    header("Location: posts.php");
}
else{
    echo "An unexpected error has occurred.";
}

