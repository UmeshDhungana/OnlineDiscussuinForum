<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include 'connect.php';
    //include 'header.php';
    //include('includes/all_head.php');
    include ('includes/navbar.php');
    ?>
    <title>Categories</title>
</head>
<body>
<?php
    $query = "select * from users";
    $result = mysqli_query($con,$query);
?>
<div class="container">
    <h3 align="center"><a href="/DiscussionForum/signup.php">Add New User</a></h3>
    <h2 class="sub-header">User List</h2>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            </thead>
            <tbody>
            <?php
            while ($res = mysqli_fetch_assoc($result))
            {
                ?>
                <tr>
                    <td><?php echo stripslashes($res["u_name"]); ?></td>
                    <td><?php echo $res['u_email']?></td>
                    <td><?php echo $res["u_level"]?></td>
                </tr>
            <?php }?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>

