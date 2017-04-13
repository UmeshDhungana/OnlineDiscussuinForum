<?php //session_start();?>
<!DOCTYPE html>
<html >
<head>
<!--    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />-->
<!--    <meta name="description" content="A short description." />-->
<!--    <meta name="keywords" content="put, keywords, here" />-->
    <title>Disussion Forum</title>
    <link rel="stylesheet" href="style.css" type="text/css">
    <script src="js/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.3.js"></script>
    <script src="js/main.js"></script>
</head>
<body>
<h1>Discussion Forum</h1>
<div id="wrapper">
    <div id="menu">
        <a class="item" href="index.php">Home</a> -
        <a class="item" href="create_post.php">Create a post</a> -
        <a class="item" href="create_category.php">Create a category</a>

        <div id="userbar">
            <div id="userbar">
                <?php
                //session_start();
                if(isset($_SESSION['u_name'])) {
                    echo 'Hello ' . $_SESSION['u_name'] . '. Not you? <a href="logout.php"> Logout </a> ';
                }
                else {
                    echo '<a href="login.php">Log in</a> or <a href="signup.php">Create Account</a>.';
                }
                ?>
            </div>

        </div>
        <div id="menu">

