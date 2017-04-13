<?php
//session_start();
include 'connect.php';
include 'includes/navbar.php';

if($_SERVER['REQUEST_METHOD'] != 'POST') {
    //echo 'This file cannot be called directly';
    $query = "SELECT * FROM posts, users
              WHERE posts.post_by = users.u_id AND posts.post_id = '". mysqli_real_escape_string($con,$_GET['post_id'])."' ";
    //echo $query;
    $result = mysqli_query($con,$query);
    while($row= mysqli_fetch_assoc($result)) {
        ?>
            <div class="container">
                <?php echo '<h2>' .$row['post_content']. '</h2>'; ?>
            </div>
        <?php
        echo '
            <div class="container" >

            <form method="post" action="add_reply.php" id="reply-form" enctype="multipart/form-data" class="form-group">
                <h2 class="form-signin-heading" >Add Reply</h2>
                <textarea rows="10" name="reply_content" id="reply-content" class="form-control" style="width: 60%" placeholder="Write your Reply here"></textarea>
                <input type="hidden" name="post_id" id="reply" value="'.$row['post_id'].'">
                <input type="submit" id="reply-submit" class="btn btn-primary " value="Submit reply" />
            </form>
        </div>
    ';
    }

}
else {
    if(!$_SESSION['logged_in']) {
        echo 'You must be logged in to post reply';
    }
    else {




//        $reply=$_POST['response'];
//        $id = $_POST['qsn_id'];
       // $sql = "INSERT INTO replies(reply_content, post_id, reply_by) VALUES ('$reply',$id, " . $_SESSION['u_id'] . ") ";
        $sql = "INSERT INTO replies(reply_content,reply_date, post_id, reply_by)
                VALUES ('" . $_POST['reply_content'] . "',NOW(), " . mysqli_real_escape_string($con,$_POST['post_id']) . ", " . $_SESSION['u_id'] . ") ";

        $result = mysqli_query($con,$sql) or die($sql);
        $query = "select * from replies";

        $result1 = mysqli_query($con,$query);
        if($result1){
            ?>
            <div class="alert alert-success" role="alert">
                <strong>Message:</strong>Your reply has been successfully posted.
            </div>
            <?php

        }else{
            echo "Unsuccess";
        }



    }
}
?>

