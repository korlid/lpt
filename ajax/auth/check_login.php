<?php 
include('../../config/config.php');
$connection = connectDB();

$username = mysqli_real_escape_string($connection,$_POST['username']);
$password = mysqli_real_escape_string($connection,md5($_POST['password']));


$sql_check = "SELECT count(username) as count  FROM tb_admin WHERE username = '$username' ";
$rs_check = mysqli_query($connection,$sql_check);
$row_check = mysqli_fetch_array($rs_check);
if($row_check['count'] > 0)
{
    $sql_check1 = "SELECT count(*) as count  FROM tb_admin WHERE username = '$username' AND password = '$password' ";
    $rs_check1 = mysqli_query($connection,$sql_check1);
    $row_check1 = mysqli_fetch_array($rs_check1);
    if($row_check1['count'] > 0)
    {
        $sql = "SELECT * FROM tb_admin WHERE username = '$username' AND password = '$password' ";
        $rs = mysqli_query($connection,$sql);
        $row = mysqli_fetch_array($rs);
        $_SESSION['admin_user_id'] = $row['id'];
        $_SESSION['name'] = $row['username'];
        $_SESSION['username'] = $row['username'];

        $last_login = date('Y-m-d H:i:s');
        $sql2 = "UPDATE tb_admin SET last_login = '$last_login' WHERE id = '".$row['id']."'  ";
        mysqli_query($connection,$sql2);

        $arr['result'] = 1;
    }
    else
    {
        $arr['result'] = 2; // รหัสผ่านผิด
    }
}
else
{
    $arr['result'] = 0; // ไม่มี username นี้ในระบบ
}
echo json_encode($arr);
?>