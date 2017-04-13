<?php
/**
 * Created by PhpStorm.
 * User: UMESH
 * Date: 10/24/2016
 * Time: 9:43 PM
 */

$db_server = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "forum";

$con= mysqli_connect($db_server, $db_username, $db_password,$db_name);

if(!$con) {
    die("Error: Could not connect " .mysqli_connect_error());
}