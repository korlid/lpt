<?php 
@session_start();
include('../../config/config.php');
$connection = connectDB();

$cart_id = mysqli_real_escape_string($connection,$_POST['cart_id']);

$sql = "SELECT * FROM tb_cart WHERE id = '$cart_id' ";
$rs = mysqli_query($connection,$sql);
$row = mysqli_fetch_array($rs);

$sql_product = "SELECT * FROM tb_product WHERE id = '".$row['product_id']."' ";
$rs_product = mysqli_query($connection,$sql_product);
$row_product = mysqli_fetch_array($rs_product);

$amount = $row['amount'] - 1;
$product_price = $row_product['price'];
$price_unit = $product_price;

if($amount <= 0)
{
    $sql_delete = "DELETE FROM tb_cart WHERE id = '$cart_id' ";
    mysqli_query($connection,$sql_delete);
    $arr['result'] = 1;
}
else
{
    $price_sum = $product_price * $amount;

    $sql2 = "UPDATE tb_cart SET amount = '$amount'
    ,price_unit = '$price_unit'
    ,price_sum = '$price_sum'
    WHERE id = '".$row['id']."'
    ";
    $rs2 = mysqli_query($connection,$sql2);

    $amount_new = $row_product['amount'] + 1 ;
    $sql_update = "UPDATE tb_product SET amount = '$amount_new'
    WHERE id = '".$row_product['id']."' 
    ";
    $rs_update = mysqli_query($connection,$sql_update);
    $arr['result'] = 1;
}




echo json_encode($arr);

?>