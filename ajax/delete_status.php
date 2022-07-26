<?php 

include('../config/config.php');
$connection = connectDB();

$id = $_POST['id'];
$table = $_POST['table'];
$date_now = date('Y-m-d H:i:s');

$sql = "UPDATE $table SET delete_status = '1',updated = '$date_now' WHERE id = '$id';";
$rs = mysqli_query($connection,$sql);
$arr['result'] = 1;
echo json_encode($arr);
?>