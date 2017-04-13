<?php
/**
 * Created by PhpStorm.
 * User: UMESH
 * Date: 11/5/2016
 * Time: 12:06 PM
 */

//session_destroy();
session_start();
if(isset($_SESSION['u_id'])) {
    unset($_SESSION['u_id']);
    unset($_SESSION['u_name']);
    session_destroy();
    //echo "lout";
    header("location:login.php");
}else{
    echo "Already logged out";
}
