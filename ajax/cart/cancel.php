<?php
@session_start();
include('../../config/config.php');
$connection = connectDB();

$id = $_POST['id'];

$sql1 = "SELECT * FROM tb_cart WHERE id = '$id' ";
$rs1 = mysqli_query($connection,$sql1);
$row1 = mysqli_fetch_array($rs1);

$sql2 = "SELECT * FROM tb_product WHERE id = '".$row1['product_id']."' ";
$rs2 = mysqli_query($connection,$sql2);
$row2 = mysqli_fetch_array($rs2);
$amount = $row2['amount'] + $row1['amount'];

$sql3 = "UPDATE tb_product SET amount = '$amount' WHERE id = '".$row1['product_id']."' ";
$rs3 = mysqli_query($connection,$sql3);



$sql = "DELETE FROM tb_cart WHERE id = '$id' ";
$rs = mysqli_query($connection,$sql);

$arr['result'] = 1;
echo json_encode($arr);
