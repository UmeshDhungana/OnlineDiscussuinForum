<!DOCTYPE html>
<html lang="en">
<head>
    <?php

    //include ('includes/navbar.php');
    session_start();
    include 'connect.php';
    include('includes/all_head.php')?>
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
              <a class="navbar-brand" href="/DiscussionForum/index.php"">  &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; Discussion Forum for DWIT</a>
            </div>
        </div>
    </nav>
    <title>Login</title>
</head>

<?php


if(isset($_SESSION['u_id'])) {
    echo '
            <div class="alert alert-info" role="alert">
                <strong>You are already logged in.</strong> Click here <a href = "logout.php">Logout</a></br>
            </div>
             ';
}
else {
    ?>
    <div class="container">

        <form method="post" action="" class="form-signin">
            <h2 class="form-signin-heading">Please sign in</h2>
            <label for="u_name" class="sr-only">Username</label>
            <input type="text" name="u_name" id="u_name" class="form-control" style="width: 30%" placeholder="Username" required autofocus></br>
            <label for="u_pass" class="sr-only">Password</label>
            <input type="password" name="u_pass" id="u_pass" class="form-control" style="width: 30%" placeholder="Password" required></br>

            <button class="btn  btn-primary " type="submit">Login</button>
        </form>

    </div> <!-- /container -->

    <?php
    }
if(isset($_POST['u_name'])&& isset($_POST['u_pass']))
{
        $errors = array();

        $u_name = $_POST['u_name'];
        $u_pass = $_POST['u_pass'];

        $u_name = stripslashes($u_name);
        $u_pass = md5(stripslashes($u_pass));
        $u_name = mysqli_real_escape_string($con,$u_name);
        $u_pass = mysqli_real_escape_string($con,$u_pass);


        if (!empty($errors)) {
            echo "Some of the fields are filled incorrectly ";
            echo '<ul>';
            foreach ($errors as $key => $value) {
                echo '<li>' . $value . '</li>';
            }
            echo '</ul>';
        }
        else {
            $query = "SELECT u_id,u_name,u_level
                      FROM users
                      WHERE u_name = '$u_name' AND u_pass='$u_pass'";
            $result = mysqli_query($con, $query);

            if (!$result) {
                echo "Something went wrong while logging in. Please try again later.";
                //session_destroy();
                echo mysqli_error($con);
            }

            else{
                $_SESSION['logged_in'] = true;
                while($row = mysqli_fetch_assoc($result)) {
                    $_SESSION['u_id']    = $row['u_id'];
                    $_SESSION['u_name']  = $row['u_name'];
                    $_SESSION['u_level'] = $row['u_level'];
                }
                header("location:index.php");

//                echo 'Welcome, ' . $_SESSION['u_name'];
//                echo ' <a href="index.php"> Proceed to the forum overview</a>';
               // $_SESSION['user'] =  "Welcome ".$_POST['u_name'];
                //header("location:nextpage.php");
            }
        }
}
include 'footer.php';
?>
