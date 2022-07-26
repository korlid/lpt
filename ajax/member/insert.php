<?php
@session_start();
include('../../config/config.php');
$connection = connectDB();

$group_type = mysqli_real_escape_string($connection, $_POST['group_type']);
$status = mysqli_real_escape_string($connection, $_POST['status']);
$username = mysqli_real_escape_string($connection, $_POST['username']);
$password = mysqli_real_escape_string($connection, md5($_POST['password']));
$name = mysqli_real_escape_string($connection, ($_POST['name']));
$car = mysqli_real_escape_string($connection, ($_POST['car']));
$date_now = date('Y-m-d H:i:s');

$sql = "INSERT INTO tb_admin SET group_type = '$group_type'
    ,status = '$status'
    ,username = '$username'
    ,password = '$password'
    ,name = '$name'
    ,car = '$car'
    ,delete_status = 0
    ,created = '$date_now'
    ,updated = '$date_now'
    ";
$rs = mysqli_query($connection, $sql);

$arr['result'] = 1;
echo json_encode($arr);
