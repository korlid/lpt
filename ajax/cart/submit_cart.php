<?php
@session_start();
include('../../config/config.php');
$connection = connectDB();

$id = $_SESSION['admin_user_id'];


$sql_check = "SELECT * FROM tb_cart WHERE admin_id = $id";
$rs_check = mysqli_query($connection,$sql_check);
$row_check = mysqli_fetch_array($rs_check);
if($row_check)
{
    //=== Get Value ===
    $amount = 0;
    $price = 0;
    $sql = "SELECT * FROM tb_cart WHERE admin_id = '$id' ";
    $rs = mysqli_query($connection,$sql);
    while($row = mysqli_fetch_array($rs))
    {
        $amount = $amount + $row['amount'];
        $price = $price + $row['price_sum'];
    }
    //===========

    $order_number = date('dmyhis');
    $date = date('Y-m-d H:i:s');

    $order = "INSERT INTO tb_order SET admin_id = '$id'
    ,order_number = '$order_number'
    ,status = 'check'
    ,amount = '$amount'
    ,price = '$price'
    ,created = '$date'
    ";
    $rs_order = mysqli_query($connection,$order);
    $last_id = mysqli_insert_id($connection);

    $sql = "SELECT * FROM tb_cart WHERE admin_id = '$id' ";
    $rs = mysqli_query($connection,$sql);
    while($row = mysqli_fetch_array($rs))
    {
        $sql2 = "INSERT INTO tb_order_list set order_id = '$last_id'
         ,product_id = '".$row['product_id']."'
         ,amount = '".$row['amount']."'
         ,price_unit = '".$row['price_unit']."'
         ,price_sum = '".$row['price_sum']."'
         ,created = '$date'
         ";
         $rs2 = mysqli_query($connection,$sql2);
    }

    $sql_delete = "DELETE FROM tb_cart WHERE admin_id = '$id'  ";
    mysqli_query($connection,$sql_delete);
    $arr['result'] =1;
    $arr['iduse'] = $last_id;
}
else
{
    $arr['result'] =0;
}


echo json_encode($arr);
