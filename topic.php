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

//$query = "select * from posts where post_topic=".$_GET['topic_id'];
//echo $query;
//$result = mysqli_query($con,$query);
//while($row = mysqli_fetch_assoc($result)){
//    $id = $row['post_id'];
//    $query1 = "select * from replies where post_id = $id";
//    $result1 = mysqli_query($con,$query1);
//    while($row1 = mysqli_fetch_assoc($result1)){
//        echo $row1['reply_content'];
//    }
//}




    $sql = "SELECT topic_id, topic_subject
          FROM topics
          WHERE topic_id = '" . mysqli_real_escape_string($con,$_GET['topic_id']). "'   ";



    $tresult = mysqli_query($con,$sql);
    //echo $sql;
    //$res = mysqli_fetch_assoc($tresult);

    if(!$tresult) {
        echo 'Topic could not be displayed, please try again later. </br>' . mysqli_error($con);
    }

    else {
        if(mysqli_num_rows($tresult) == 0) {
            echo 'This topic does not exist.';
        }
        else {
            while($row = mysqli_fetch_assoc($tresult)) {
                $query = "SELECT posts.post_id, posts.post_topic,posts.post_content, posts.post_date, posts.post_by, users.u_id,users.u_name
                  FROM posts
                  LEFT JOIN users
                  ON posts.post_by = users.u_id
                  WHERE posts.post_topic =  '". mysqli_real_escape_string($con,$_GET['topic_id']) ."' ";

               // echo $query;

//            $query = "SELECT * FROM posts, users WHERE posts.post_by = users.u_id AND posts.post_topic = '". mysqli_real_escape_string($con,$_GET['topic_id'])."' ";

            $result = mysqli_query($con,$query);
            if(!$result) {
                echo 'The posts could not be displayed, please try again later.';
            }
            else {
                if(mysqli_num_rows($result) == 0) {
                    ?>
                    <div class="alert alert-danger" role="alert">
                        <strong>Message:</strong>There are no post in this topic yet.
                    </div>
                    <?php

                }
                else {
                    ?>

                    <div class="container">
                        <h2 class="sub-header"></h2>
                        <div class="table-responsive">
                        <table class="table table-bordered table bg-info">
                            <thead>
                            <th>Asked by</th>
                            <th>Date</th>
                            <th>Question</th>
                            <th colspan="2" align="center">Action</th>
                            </thead>

                            <tbody>
                        <?php
                        while ($res = mysqli_fetch_assoc($result)) {
                            ?>
                                            <tr>
                                                <td><?php echo $res['u_name']; ?></td>
                                                <td><?php echo date('d-m-Y', strtotime($res['post_date'])); ?></td>
                                                <td><?php echo '<h4> '.$res['post_content'].' </h4> '; ?></td>
                                                <td><?php echo '<a href="reply.php?post_id='.$res['post_id'] .'">View Reply</a>'; ?></td>
                                                <td><?php echo '<a href="add_reply.php?post_id='.$res['post_id'].'">Add Reply</a>'; ?></td>
                                            </tr>


                   <?php } ?>
                            </tbody>
                        </table>
                        </div>
                    </div>
                <?php
                }
            }
       }

    }
}
?>
</body>
</html>


