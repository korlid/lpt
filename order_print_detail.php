<?php
require('config/config.php');
$connection = connectDB();
require_once('mpdf/mpdf.php'); //ที่อยู่ของไฟล์ mpdf.php 
ob_start(); 

?>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">

<style type="text/css">
    <!--
    @page rotated {
        size: landscape;
    }

    .style1 {
        font-family: "TH SarabunPSK";
        font-size: 18pt;
        font-weight: bold;
    }

    .style2 {
        font-family: "TH SarabunPSK";
        font-size: 16pt;
        font-weight: bold;
    }

    .style3 {
        font-family: "TH SarabunPSK";
        font-size: 16pt;

    }

    .style5 {
        cursor: hand;
        font-weight: normal;
        color: #000000;
    }

    .style9 {
        font-family: Tahoma;
        font-size: 12px;
    }

    .style11 {
        font-size: 12px
    }

    .style13 {
        font-size: 9
    }

    .style16 {
        font-size: 9;
        font-weight: bold;
    }

    .style17 {
        font-size: 16px;
        font-weight: bold;
    }
    
    -->
</style>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>

<head>
    <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
</head>

<body>
<table style="width:100%">
    <tbody>
            <tr>
                <td align="center">
                    <b style="font-size:30px;">บจก.ลำลูกกาพลาสติกและขนส่ง</b><br/><br/><br/>
                </td>
            </tr>
        </tbody>
    </table>
        <tbody>
                    <td align="center">
                    <span>ที่อยู่ ต.คลองสาม อ.คลองหลวง จ.ปทุมธานี 12120 Tel.02-101-8747</span><br/>
                    </td>
        </tbody>
    <table style="width:100%">
        <tbody>
            <tr><td colspan="2" align="center"><hr class="style5"></td></tr>
           
        </tbody>
    </table>

    <table style="width:100%">
        <tbody>
            <tr>
                <td style="width:70%" align="left"><b>ชื่ออุปกรณ์</b></td>
                <td style="width:10%" align="right"><b>จำนวน</b></td>
                <td style="width:20%" align="right"><b>ราคา</b></td>
            </tr>
            {{-- Loop อาหาร --}}
            <?php 
            $sql = "SELECT * FROM tb_order WHERE id = '" . @$_GET['id'] . "' ";
            $rs = mysqli_query($connection, $sql);
            $row = mysqli_fetch_array($rs);
            $sql1 = "SELECT orders.*
            ,product.name AS pname
            ,product.price AS proprice
            ,product.amount AS proamount
            ,olist.amount AS oamount
            ,olist.price_sum AS price_sum
            ,admin.name AS aname
            ,admin.car AS acar
            FROM tb_order AS orders 
            LEFT JOIN tb_order_list AS olist ON orders.id = olist.order_id
            LEFT JOIN tb_product AS product ON olist.product_id = product.id
            LEFT JOIN tb_admin AS admin ON orders.admin_id = admin.id
            WHERE orders.id = '" . $_GET['id'] . "'
            ";
                    $rs1 = mysqli_query($connection, $sql1);
                    $i = 0;
                    $money = 0;
                    $price = 0;
                    while ($row1 = mysqli_fetch_array($rs1)) {
                        $i++;
                        $money = $row1['oamount'] * $row1['proprice'];  
                        //oamout คือจำนวนในลิสต์ proamout คือจำนวนสินค้าทั้งหมดอย่าลืมนะไองั่ง
            ?>

    

             <tr>
                <td><?php echo $row1['pname'] ?> </td>
                <td align="right"><?php echo $row1['oamount'] ?></td>
                <td align="right"><?php echo number_format($row1['price_sum'], 2); ?></td>
            </tr>
          
            
            <?php 
                    $price = $price + $row1['price_sum'];
                    $aname = $row1['aname'];
                    $acar = $row1['acar'];
                    $sumamount = $row1['amount'];

                }

            ?>
           

 
            <tr>
                <td  style="width:70%" align="left"><b>รวม </b></td>
                <td style="width:10%" align="right"><b><?php echo number_format($sumamount); ?></b></td>
                <td style="width:20%" align="right"><b><?php echo number_format($price,2); ?></b></td>
            </tr>
            

            <tr><td colspan="4" align="center"><hr class="style5"></td></tr>
        

        </tbody>
       
            
    </table>

    <table style="width:100%">

        <tbody>
            <tr>              
                <td colspan="2" style="width:50%" align="left"><b>ชื่อผู้เบิก</b></td>
                <td><?php echo $aname ;?> </td>
            </tr> 
        </tbody>
        <tbody>
            <tr>              
                <td colspan="2" style="width:50%" align="left"><b>เลขทะเบียนรถ</b></td>
                <td><?php echo $acar ;?> </td>
            </tr> 
        </tbody>
                  
    </table>
   
    
</body>

</html>
<?php
$html = ob_get_contents();
ob_end_clean();
// $pdf = new mPDF('th', 'A4', '0', ''); //การตั้งค่ากระดาษถ้าต้องการแนวตั้ง ก็ A4 เฉยๆครับ ถ้าต้องการแนวนอนเท่ากับ A4-L
$pdf = new mPDF('th', array(100,200));
$pdf->autoScriptToLang = false;
$pdf->SetDisplayMode('fullpage');
$pdf->WriteHTML($html, 2);
$pdf->Output();
?>