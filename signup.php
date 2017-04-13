<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        include ('includes/navbar.php');
        include 'connect.php';
    ?>
    <title>Sign Up</title>
</head>

<?php
/**
 * Created by PhpStorm.
 * User: UMESH
 * Date: 11/2/2016
 * Time: 2:32 PM
 */



if($_SERVER['REQUEST_METHOD'] != 'POST'){
//if(!isset($_POST['submit'])){
    echo '
        <div class="container" >

        <form method="post" action="signup.php" enctype="multipart/form-data" class="form-signin">
            <h2 class="form-signin-heading" >User Registration</h2>

            <label for="u_name">Name</label>
            <input type="text" id="u_name" name="u_name" class="form-control" style="width: 30%" placeholder="Username" required autofocus></br>
            <label for="u_pass">Password</label>
            <input type="password" id="u_pass" name="u_pass" class="form-control" style="width: 30%" placeholder="Password" required ></br>
            <label for="u_confirm_pass">Confirm Password</label>
            <input type="text" id="u_confirm_pass" name="u_confirm_pass" class="form-control" style="width: 30%" placeholder="Confirm Password" required ></br>
            <label for="u_email">E-mail</label>
            <input type="text" id="u_email" name="u_email" class="form-control" style="width: 30%" placeholder="Email" required ></br>
            <label for="u_level">Role</label>
            <input type="text" id="u_level" name="u_level" class="form-control" style="width: 30%" placeholder="Role" required ></br>

            <button class="btn btn-primary " type="submit" name="submit">Add Category</button>
        </form>

    </div>


        ';
}

else {
    $errors = array();
    if(isset($_POST['u_name'])) {
        $u_name = "\"".$_POST['u_name']."\"";
        $u_email = "\"".$_POST['u_email']."\"";
        $u_level = "\"".$_POST['u_level']."\"";
        if(!ctype_alnum($_POST['u_name'])) {
            $errors[] = "Username must be the combination of letters and digits only";
        }
        if(strlen($_POST['u_name']) > 20)
        {
            $errors[] = "Username can be of 20 characters in maximum";
        }

    }
    else {
        $errors[] = "Username field is empty";
    }

    if(isset($_POST['u_pass']))
    {
        $u_pass = "\"".$_POST['u_pass']."\"";
        if($_POST['u_pass'] != $_POST['u_confirm_pass']) {
            $errors[] = "Password didn't match";
        }
    }
    else {
        $errors[] = "Password field is empty";
    }

    if(!empty($errors))
    {
        echo "Some of the fields are filled incorrectly ";
        echo '<ul>';
        foreach($errors as $key => $value) {
            echo '<li>' .$value .'</li>';
        }
        echo '</ul>';



    }

    else {
//        $query = "INSERT INTO users(u_name, u_pass, u_email, u_level)
//                  VALUES ($u_name,$u_pass,$u_email,0)";

       $query=  "INSERT INTO users(u_name, u_pass, u_email ,u_date, u_level)
        VALUES('" . mysqli_real_escape_string($con,$_POST['u_name']) . "',
       '" . md5($_POST['u_pass']) . "',
       '" . mysqli_real_escape_string($con,$_POST['u_email']) . "',
       NOW(),
       '".mysqli_real_escape_string($con,$_POST['u_level'])."'  )";


        $result = mysqli_query($con,$query);

        if(!$result) {
            echo "Something went wrong while registering. Please try again later.";
        }
        else {
            echo '
            <div class="alert alert-success" role="alert">
                <strong>Message:</strong>Your reply has been successfully posted.
            </div>
             ';
        }
    }

}
