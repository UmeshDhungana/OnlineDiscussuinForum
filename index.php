<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        include 'connect.php';
        //include 'header.php';
        //include('includes/all_head.php');
        include ('includes/navbar.php');
    ?>
    <title>Index</title>
</head>

<body>

<?php
if(isset($_SESSION['u_id']) == true) {

$query = "SELECT cat_id, cat_name, cat_description
          FROM categories";

$result = mysqli_query($con, $query);

$tquery = "SELECT topic_id FROM topics ORDER BY  DATE  DESC limit 1";

if (!$result) {
    echo 'The categories could not be displayed, please try again later.';
}
else {
    if (mysqli_num_rows($result) == 0) {
        echo 'No categories defined yet.';
    }
    else {
?>
<div class="container-fluid">
    <div class="row">

        <div class="main">
        <?php

        if(($_SESSION['u_level']) == "admin") {
            ?>
                <h3 align="center"><a href="/DiscussionForum/create_category.php">Add New Category <span class="sr-only">(current)</span></a></></h3>
            <h3 align="center"><a href="/DiscussionForum/create_topic.php">Add New Topic <span class="sr-only">(current)</span></a></></h3>

            <?php } ?>
        </div>

        <div class="container">

            <h2 class="sub-header">Categories List</h2>
            <div class="table-responsive">
                <table class="table bg-info">
                    <thead>
                    <th>Category</th>
                    <th>Category Description</th>
                    </thead>
                    <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($result))
                    {
                        ?>
                        <tr>
                            <td><?php echo '<a href='."category.php?cat_id=".$row['cat_id'].'>' . $row['cat_name'] . '</a>'?></td>
                            <td><?php echo $row['cat_description'] ?></td>
                        </tr>
                    <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<?php
        }
    }

    include 'footer.php';
}
else{
    header("location:login.php");
}
?>

</body>
</html>
