<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
   <?php include('all_head.php') ?>

</head>

<body>

<!-- Static navbar -->
<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/DiscussionForum/index.php">Discussion Forum for DWIT</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="/DiscussionForum/index.php">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; Home</a></li>
                <li><a href="/DiscussionForum/create_post.php">Create Post</a></li>
                <?php
                    if(($_SESSION['u_level']) == "admin") {
                        ?>
                        <li><a href="/DiscussionForum/view_user.php">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;View User</a> </li>
                  <?php  }  ?>

            </ul>

            <ul class="nav navbar-nav navbar-right">

                <?php

                if(isset($_SESSION['u_name'])) {
                    echo  '<li> User: '. $_SESSION['u_name'] .' <a href="logout.php"> Logout </a></li> ';
                }
                else {
                    echo '<a href="login.php">Log in</a> or <a href="signup.php">Create Account</a>.';
                }
                ?>


            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
<script src="../../dist/js/bootstrap.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>
