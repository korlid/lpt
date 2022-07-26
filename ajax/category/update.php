<?php 
include('../../config/config.php');
$connection = connectDB();

$id = mysqli_real_escape_string($connection,$_POST['id']);
$name = mysqli_real_escape_string($connection,$_POST['name']);
$date_now = date('Y-m-d H:i:s');

$sql = "UPDATE tb_category SET name = '$name' 
,updated = '$date_now'
WHERE id = '$id'
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