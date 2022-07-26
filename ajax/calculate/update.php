<?php
@session_start();
include('../../config/config.php');
$connection = connectDB();

$id = mysqli_real_escape_string($connection, $_POST['id']);
$money = mysqli_real_escape_string($connection, $_POST['money']);
$date_now = date('Y-m-d H:i:s');

$sql1 = "SELECT * FROM tb_order WHERE id = '$id' ";
$rs1 = mysqli_query($connection,$sql1);
$row1 = mysqli_fetch_array($rs1);

$price_change =  $money - $row1['price'];

$sql = "UPDATE tb_order SET money = '$money'
    ,money_change = '$price_change'
    ,updated = '$date_now'
    WHERE id = '$id'
    ";
$rs = mysqli_query($connection, $sql);
$id = mysqli_insert_id($connection);


$arr['result'] = 1;
echo json_encode($arr);
