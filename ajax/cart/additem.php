<?php
@session_start();
include('../../config/config.php');
$connection = connectDB();

$id = $_POST['id'];
$user_id = $_SESSION['admin_user_id'];
$amount = 1;
$date_now = date('Y-m-d H:i:s');
$sql = "SELECT count(*) as count FROM tb_cart WHERE product_id = '$id' AND admin_id = '$user_id' ";
$rs = mysqli_query($connection,$sql);
$row = mysqli_fetch_array($rs);

$sql_product = "SELECT * FROM tb_product WHERE id = '$id' ";
$rs_product = mysqli_query($connection,$sql_product);
$row_product = mysqli_fetch_array($rs_product);
$product_price = $row_product['price'];
$price_unit = $product_price;
$amount_new = $row_product['amount'] - 1;
if($row_product['amount'] <= 0)
{
    $arr['result'] = 4;
}
else
{
    if($row['count']>0)
    {
        $sql1 = "SELECT * FROM tb_cart WHERE product_id = '$id' AND admin_id = '$user_id' ";
        $rs1 = mysqli_query($connection,$sql1);
        $row1 = mysqli_fetch_array($rs1);
        $old_amount = $row1['amount'];
        $amount = $amount + $old_amount;

        $price_sum = $product_price * $amount;
    
        $sql2 = "UPDATE tb_cart SET amount = '$amount'
        ,price_unit = '$price_unit'
        ,price_sum = '$price_sum'
        WHERE id = '".$row1['id']."'
        ";
        $rs2 = mysqli_query($connection,$sql2);

        
        $sql_update = "UPDATE tb_product SET amount = '$amount_new'
        WHERE id = '$id' 
        ";
        $rs_update = mysqli_query($connection,$sql_update);
        $arr['result'] = 1;

    }
    else
    {
        $price_sum = $product_price * $amount;
        $sql2 = "INSERT INTO tb_cart SET product_id = '$id'
        ,admin_id = '$user_id'
        ,amount = '$amount'
        ,price_unit = '$price_unit'
        ,price_sum = '$price_sum'
        ,created = '$date_now'
        ";
        $rs2 = mysqli_query($connection,$sql2);
        
        $sql_update = "UPDATE tb_product SET amount = '$amount_new'
        WHERE id = '$id' 
        ";
        $rs_update = mysqli_query($connection,$sql_update);
        $arr['result'] = 1;
    }
}

echo json_encode($arr);
