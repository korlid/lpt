<?php
@session_start();
include('../../config/config.php');
$connection = connectDB();

$id = mysqli_real_escape_string($connection, $_POST['id']);
$name = mysqli_real_escape_string($connection, $_POST['name']);
$price = mysqli_real_escape_string($connection, $_POST['price']);
$amount = mysqli_real_escape_string($connection, $_POST['amount']);
$category_id = mysqli_real_escape_string($connection, $_POST['category_id']);
$unit = mysqli_real_escape_string($connection, $_POST['unit']);

$date_now = date('Y-m-d H:i:s');

$sql = "UPDATE tb_product SET name = '$name'
    ,price = '$price'
    ,amount = '$amount'
    ,unit = '$unit'
    ,category_id = '$category_id'
    ,updated = '$date_now'
    WHERE id = '$id'
    ";
$rs = mysqli_query($connection, $sql);
$id = mysqli_insert_id($connection);

if ($_FILES['image'] != "") 
{
    $tmpFilePath_1 = $_FILES['image']['tmp_name'];
    $file_1  = explode(".", $_FILES['image']['name']);
    $count1 = count($file_1) - 1;
    $file_surname_1 = $file_1[$count1];
    $filename_images_1 = md5(date('mds') . rand(111, 999) . date("hsid") . rand(111, 999)) . "." . $file_surname_1;
    if ($file_surname_1 == 'jpg' || $file_surname_1 == 'jpeg' || $file_surname_1 == 'gif' || $file_surname_1 == 'png' || $file_surname_1 == 'JPG' || $file_surname_1 == 'JPEG' || $file_surname_1 == 'GIF' || $file_surname_1 == 'PNG') {
        if (move_uploaded_file($_FILES['image']['tmp_name'], "../../public/uploads/product/" . $filename_images_1)) {
            $sql = "UPDATE tb_product SET image = '$filename_images_1' WHERE id = '$id' ;";
            $rs = mysqli_query($connection, $sql);
        }
    }
}


$arr['result'] = 1;
echo json_encode($arr);
