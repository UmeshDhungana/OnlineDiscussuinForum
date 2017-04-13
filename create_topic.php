<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    //include 'header.php';
    //include('includes/all_head.php');
    include ('includes/navbar.php');
    include 'connect.php';
    ?>
    <title>Create Topic</title>
</head>
<body>
<?php

$sql_cat = "SELECT * FROM categories";
$result = mysqli_query($con,$sql_cat);


if(isset($_POST['topic_subject'])) {
    $top = $_POST['topic_subject'];
    $query = "INSERT INTO topics(topic_subject,topic_date,topic_cat,topic_by)
                    VALUES ('$top',NOW(),'" . $_POST['cat_name'] . "', ". $_SESSION['u_id'] ."
                            )
                    ";
    //echo $query;

    $res = mysqli_query($con,$query);
    if($res) {
        echo '
        <div class="alert alert-success" role="alert">
                <strong>Message:</strong>Topic added successfully.
            </div>
        ';
    }

}
?>
<div class="container" >
<form method="post" action="create_topic.php" class="form-group" enctype="multipart/form-data">
    <label for="topic_cat">Category</label>
    <select id="category-select" name="cat_name" required class="form-control" style="width: 30%">
        <?php
        $sql_cat = "SELECT * FROM categories";
        $result = mysqli_query($con,$sql_cat);

        //echo $result;
        while($row = mysqli_fetch_assoc($result)) {
            echo $row['cat_name'];
            echo '<option value=" ' . $row['cat_id'] . '">' . $row['cat_name'] . '</option>';
        } ?>
    </select> </br>

    <label for="topic_cat">Topic</label>
    <input type="text" name="topic_subject"  class="form-control" style="width: 30%" placeholder="Topic Name" required >
    </br>
    <button class="btn btn-primary " type="submit" name="submit">Add Topic</button>
</form>

</body>
</html>