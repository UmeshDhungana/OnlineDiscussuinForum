<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include 'connect.php';
    include ('includes/navbar.php');
    ?>
    <title>Reply</title>
</head>

<body>
<?php
    $query = "select * from posts where post_id=".$_GET['post_id'];
    $result = mysqli_query($con,$query);
    $row = mysqli_fetch_assoc($result);

        $id = $row['post_id'];

        $query1 = "select * from replies,users where post_id = $id AND users.u_id=replies.reply_by ";
       // echo $query1;
        $result1 = mysqli_query($con,$query1);
        ?>
<div class="container">
    <?php echo '<h2>' .$row['post_content']. '</h2>'; ?>
    <h2 class="sub-header"></h2>
    <div class="table-responsive">
        <table class="table table-bordered table bg-info">
            <thead>
                <th>Replied by</th>
                <th>Date</th>
                <th>Reply</th>
            </thead>

            <tbody>
        <?php
        while($row1 = mysqli_fetch_assoc($result1)){
            ?>
            <tr>
                <td><?php echo $row1['u_name']; ?></td>
                <td><?php echo $row1['reply_date']; ?></td>
                <td><?php echo $row1['reply_content']; ?></td>
            </tr>

       <?php } ?>
            </tbody>
            </table>
        </div>
    </div>

</body>
</html>