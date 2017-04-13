<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    //include 'header.php';
    //include('includes/all_head.php');
    include ('includes/navbar.php');
    include 'connect.php';
    ?>
    <title>Create Categories</title>
</head>
<body>
<?php

if(isset($_SESSION['logged_in']) == false) {
    //the user is not signed in
    echo 'Sorry, you have to be <a href="login.php">logged in</a> to create a category.';
}
else {

    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
        echo '

        <div class="main col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2" >

        <form method="post" action="create_category.php" enctype="multipart/form-data" class="form-signin">
            <h2 class="form-signin-heading" >Create category</h2>

            <label for="cat_name">Name</label>
            <input type="text" id="cat_name" name="cat_name" class="form-control" style="width: 30%" placeholder="Category Name" required autofocus></br>
            <label for="cat_description">Category Description</label>
            <textarea name="cat_description" id="cat_description" class="form-control" style="width: 60%" placeholder="Category Description"></textarea></br>

            <button class="btn btn-primary " type="submit" name="submit">Add Category</button>
        </form>

    </div>

    ';
    } else {
        $query = "INSERT INTO categories(cat_name, cat_description)
        VALUES('" . mysqli_real_escape_string($con, $_POST['cat_name']) . "',
       '" . mysqli_real_escape_string($con, $_POST['cat_description']) . "'
       )";

        $result = mysqli_query($con, $query);

        if (!$result) {
            echo 'Error: ' . mysqli_error($con);
        } else {
            ?>
                       <div class="alert alert-info" role="alert">
                            <strong>Message:</strong>Category Added Successfully. <a href="/DiscussionForum/index.php">Click here to view</a> </br>
                       </div>
<?php
        }
    }
}
?>
</body>
</html>
