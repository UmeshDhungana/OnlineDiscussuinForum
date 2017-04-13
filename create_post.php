<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    //include 'header.php';
    //include('includes/all_head.php');
    include ('includes/navbar.php');
    include 'connect.php';
    ?>
    <title>Create Post</title>
</head>
<body>

</body>
<script type="text/javascript">
    function jhyakne() {

        var id_number = parseInt($('#category-select option:selected').attr('value'));
        var base_url = 'http://localhost/DiscussionForum/topicAPI.php?cat_id=' + id_number;
        $.ajax({
            url: base_url,
            success: function (data) {
                var results = '';
                //var results = '<select id="topic-select" name="topic_subject" required class="form-control" style="width: 30%">';
                for(var i =0; i<data.length; i++){
                    results += '<option value="' + data[i].topic_id +  '">' + data[i].topic_subject +'</option>';
                }
                //results += '</select>';

                //$("#jhot").html(results);
                $("#topic-select").html(results);

            },
            error: function (e) {


            }

        });

    }
</script>
<?php

if(isset($_SESSION['logged_in']) == false) {
    //the user is not signed in
    echo 'Sorry, you have to be <a href="login.php">logged in</a> to create a post.';
}
else {
    if($_SERVER['REQUEST_METHOD']!= 'POST') {
//        $sql = "SELECT cat_id,cat_name,cat_description
//                FROM categories";
        $sql_cat = "SELECT cat_id,cat_name,cat_description FROM categories";
        $sql_top = "SELECT topic_id, topic_subject FROM topics";

        $result_cat = mysqli_query($con,$sql_cat);
        $result_top = mysqli_query($con,$sql_top);

        if(!$result_cat && !$result_top) {
            echo 'Error while selecting from database. Please try again.';
            echo mysqli_error($con);
        }
        else {
            if(mysqli_num_rows($result_cat) == 0)
            {
                //there are no categories, so a topic can't be posted
                if($_SESSION['u_level'] == 'admin')
                {
                    echo 'You have not created categories yet.';
                }
                else
                {
                    echo 'Before you can post a topic, you must wait for an admin to create some categories.';
                }
            }
            else
            {
                echo '

       <div class="container" >

        <form method="post" action="create_post.php" enctype="multipart/form-data" class="form-group">
            <h2 class="form-signin-heading" >Create Post</h2>


                <label for="topic_cat">Category</label>
                <select id="category-select" name="topic_cat" required class="form-control" style="width: 30%" onchange="jhyakne();">
                    ';
                while($crow = mysqli_fetch_assoc($result_cat)) {
                    echo '<option value=" ' . $crow['cat_id'] . '">' . $crow['cat_name'] . '</option>';
                }
                echo '
                </select> </br>

                <label for="topic_subject">Topic Subject</label>
                <div id="jhot">
                <select id="topic-select" name="topic_subject" required class="form-control" style="width: 30%">
                    ';
                while ($trow = mysqli_fetch_assoc($result_top)) {
                    echo '<option value="' . $trow['topic_id'] . '">' . $trow['topic_subject'] . '</option>';
                }
                echo '
                </select>


                 </div>
                 </br>


            <label for="post_content">Question</label>
            <textarea name="post_content" id="post_content" class="form-control" style="width: 60%" placeholder="Write your Question here"></textarea></br>

            <button class="btn btn-primary " type="submit" name="submit">Create Post</button>
        </form>

    </div>
                     ';


            }
        }
    }
    else {
        $query = "BEGIN WORK";
        $result = mysqli_query($con,$query);

        if(!$result) {
            echo "Error occured while creating topic.. Please try again.";
        }
        else {
            //form has been posted, save it. Inserting topic into topic tale, post into post table
            $sql = "INSERT INTO topics(topic_subject,topic_date,topic_cat,topic_by)
                    VALUES ('".mysqli_real_escape_string($con,$_POST['topic_subject'])."',
                            NOW(),
                            '" . mysqli_real_escape_string($con,$_POST['topic_cat']) . "',
                            '" . $_SESSION['u_id'] . "')
                    ";
            //$topicid = mysqli_insert_id($con);
            $topicid=$_POST['topic_subject'];

            $sql = "INSERT INTO posts(post_content, post_date, post_topic, post_by)
                        VALUES
                            ('" . mysqli_real_escape_string($con,$_POST['post_content']) . "',
                                  NOW(),
                                  " . $topicid . ",
                                  " . $_SESSION['u_id'] . "
                            )";
            //echo $sql;
            $result = mysqli_query($con,$sql);

            if(!$result)
            {
                echo 'Error occured while inserting your post. Please try again later.' . mysqli_error($con);
                $sql = "ROLLBACK;";
                $result = mysqli_query($con,$sql);
            }
            else
            {
                $sql = "COMMIT;";
                $result = mysqli_query($con,$sql);

                echo '
                <div class="alert alert-success" role="alert">
                <strong>Message:</strong>You have successfully created a post.
            </div>
                ';
            }
            //}
        }
    }
}