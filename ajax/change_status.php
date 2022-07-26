<?php

include('../config/config.php');
$connection = connectDB();

$id = $_GET['id'];
$table = $_GET['table'];
$sql = "SELECT status FROM $table WHERE id = '$id';";
$rs = mysqli_query($connection, $sql);
$row = mysqli_fetch_array($rs);

if($row['status'] == "on")
{
    $new_status = 'off';
}
else
{
    $new_status = 'on';
}


$sql = "UPDATE $table SET status = '$new_status' WHERE id = '$id';";
$rs = mysqli_query($connection, $sql);
$arr['result'] = 1;
echo json_encode($arr);
