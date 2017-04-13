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

$query = "SELECT cat_id,cat_name, cat_description
          FROM categories
          WHERE cat_id = " . mysqli_real_escape_string($con,$_GET['cat_id']);

//echo $query;

$result = mysqli_query($con,$query);

if(!$result) {
    echo '
<div class="alert alert-danger" role="alert">
        <strong>Message: </strong>Category could not be displayed, please try again later. </br>
      </div>
        ' . mysqli_error($con);
}

else {
    if(mysqli_num_rows($result) == 0) {
        echo '
                       <div class="alert alert-danger" role="alert">
                            <strong>Message:</strong> This category does not exist. </br>
                       </div>   ';
    }
    else {
        while($row = mysqli_fetch_assoc($result)) {
            echo '
                    <div class="container">
                    <h2>Topics in ′' . $row['cat_name'] . '′ category</h2>
                    </div>
                 ';
        }

        //do a query for the topics
        $query = "SELECT topic_id, topic_subject,topic_date,topic_cat, topic_by
                  FROM topics
                  WHERE topic_cat =  '".mysqli_real_escape_string($con,$_GET['cat_id'])."'   ";
        //echo $query;

        $result = mysqli_query($con,$query);
        if(!$result) {
            echo '
                       <div class="alert alert-info" role="alert">
                            <strong>Message:</strong> The topics could not be displayed. </br>
                       </div>   ';
        }
        else {
            if(mysqli_num_rows($result) == 0)
            {
                echo '
                       <div class="alert alert-danger" role="alert">
                            <strong>Message:</strong> Topics has not yet been Created </br>
                       </div>   ';
            }
            else { ?>
                <div class="container">

                    <h2 class="sub-header"></h2>
                    <div class="table-responsive">
                        <table class="table table bg-info">
                            <thead>
                            <th>Topic</th>
<!--                            <th>Created By</th>-->
                            <th>Created At</th>
                            </thead>
                            <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($result))
                            {
                                ?>
                                <tr>
                                    <td><?php echo '<a href="topic.php?topic_id='.$row['topic_id'] . '">' . $row['topic_subject'] . '</a>'?></td>
<!--                                    <td>--><?php
//                                        $uQuery = "select u_name from users where u_id=".$row['topic_by'];
//                                        $resu = mysqli_query($con,$uQuery);
//                                        echo mysqli_fetch_assoc($resu)['u_name'];
//                                        //echo $row['topic_by']; //echo $_SESSION['u_name'] ?><!--</td>-->
                                    <td><?php echo date('d-m-Y', strtotime($row['topic_date'])) ?></td>
                                </tr>
                            <?php }?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php

            }
        }
    }
}
?>

</body>
</html>

