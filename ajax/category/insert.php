<?php 
include('../../config/config.php');
$connection = connectDB();

$name = mysqli_real_escape_string($connection,$_POST['name']);
$date_now = date('Y-m-d H:i:s');

$sql = "INSERT INTO tb_category SET name = '$name' 
,status = 'on'
,delete_status = 0
,created = '$date_now'
";
$rs = mysqli_query($connection,$sql);
if($rs)
{
    $arr['result'] = 1;
}
else
{
    $arr['result'] = 0;
}
echo json_encode($arr);
?>