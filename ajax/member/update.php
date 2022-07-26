<?php
@session_start();
include('../../config/config.php');
$connection = connectDB();

$id = mysqli_real_escape_string($connection, $_POST['id']);
$group_type = mysqli_real_escape_string($connection, $_POST['group_type']);
$status = mysqli_real_escape_string($connection, $_POST['status']);
$username = mysqli_real_escape_string($connection, $_POST['username']);
$password = mysqli_real_escape_string($connection, md5($_POST['password']));
$name = mysqli_real_escape_string($connection, $_POST['name']);
$car = mysqli_real_escape_string($connection, $_POST['car']);
$date_now = date('Y-m-d H:i:s');

if($_POST['password'] != null)
{
    $sql = "UPDATE tb_admin SET group_type = '$group_type'
    ,status = '$status'
    ,password = '$password'
    ,updated = '$date_now'
    WHERE id = '$id'
    ";
}
else
{
    $sql = "UPDATE tb_admin SET group_type = '$group_type'
    ,status = '$status'
    ,updated = '$date_now'
    WHERE id = '$id'
    ";
}


$rs = mysqli_query($connection, $sql);


$arr['result'] = 1;
echo json_encode($arr);
