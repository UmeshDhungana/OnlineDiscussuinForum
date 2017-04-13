<?php

header('Content-Type: application/json');

include "connect.php";


$sql = "SELECT cat_id, cat_name
          FROM categories
          WHERE cat_id = '" . mysqli_real_escape_string($con,$_GET['cat_id']). "'   ";


//echo $sql;

$tresult = mysqli_query($con,$sql);

while($row = mysqli_fetch_assoc($tresult)) {

    $query = "INSERT INTO topics(topic_subject)
                    VALUES ('".mysqli_real_escape_string($con,$_POST['topic_subject'])."'
                    ";

}
$result = mysqli_query($con,$query);

//print_r($query);
$emparray = array();

while($row = mysqli_fetch_assoc($result)) {
    $emparray[] = $row;
}

echo json_encode($emparray);