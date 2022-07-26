<?php
require('config/config.php');
$connection = connectDB();
require_once('mpdf/mpdf.php'); //ที่อยู่ของไฟล์ mpdf.php นะไอสัส
ob_start(); // ทำการเก็บค่า html นะสัส

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
                    <b style="font-size:30px;">บจก.ลำลูกกาพลาสติก และ ขนส่ง</b><br />
                    <span>รายงานการเบิก</span> <br /><br />
                    <span>ตามรายการวันที่ <?php echo date('d/m/Y',strtotime(@$_GET['start_date'])) ?> - <?php echo date('d/m/Y',strtotime(@$_GET['end_date'])) ?></span> <br />
                </td>
            </tr>
        </tbody>
    </table>

    <table style="width:100%">
        <tbody>
            <tr>
                <td align="center">
                &nbsp;
                </td>
            </tr>
        </tbody>
    </table>

    <table style="width:100%; border: 1px solid black; border-collapse: collapse;">
        <tr>
            <th style="border: 1px solid black; border-collapse: collapse; width:16%;">หมายเลขใบเบิก</th>
           
            <th style="border: 1px solid black; border-collapse: collapse; width:36%;">รายละเอียด</th>
            <th style="border: 1px solid black; border-collapse: collapse; width:8%;">จำนวน</th>
            <th style="border: 1px solid black; border-collapse: collapse; width:14%;">วันที่</th>
            <th style="border: 1px solid black; border-collapse: collapse; width:14%;">รวมทั้งสิ้น</th>
        </tr>
        <?php 
            $sql = "SELECT * FROM tb_order WHERE created >= '".$_GET['start_date']." 00:00:00' AND created <= '".$_GET['end_date']." 23:59:59'";
            $rs = mysqli_query($connection,$sql);
            $price = 0;
            while($row = mysqli_fetch_array($rs))
            {

            ?>
        <tr>
            <td style="border: 1px solid black; border-collapse: collapse; text-align: center;"><?php echo $row['order_number'] ?></td>
            
            <td style="border: 1px solid black; border-collapse: collapse;">&nbsp;
                <?php 
                $sql1 = "SELECT * FROM tb_order_list WHERE order_id  = '".$row['id']."' ";
                $rs1 = mysqli_query($connection,$sql1);
                while($row1 = mysqli_fetch_array($rs1))
                {
                    $sql2 = "SELECT * FROM tb_product WHERE id  = '".$row1['product_id']."' ";
                    $rs2 = mysqli_query($connection,$sql2);
                    $row2 = mysqli_fetch_array($rs2);
                    echo $row2['name'],', ';
                }
                
                
                ?>
            </td>
            <td style="border: 1px solid black; border-collapse: collapse; text-align: center;"><?php echo $row['amount']; ?></td>
            <td style="border: 1px solid black; border-collapse: collapse; text-align: center;"><?php echo date('d/m/Y',strtotime($row['created'])) ?></td>
            <td style="border: 1px solid black; border-collapse: collapse; text-align: right;"><?php echo number_format($row['price'],2) ?> บาท</td>
        </tr>
        <?php 
            $price = $price + $row['price']; ;
            }
        ?>
        <?php 
        for($e=0;$e<9;$e++)
        {
        ?>
        
        <tr>
            <td style="border: 1px solid black; border-collapse: collapse; text-align: center;">&nbsp;</td>
            <td style="border: 1px solid black; border-collapse: collapse;"> &nbsp;</td>
            <td style="border: 1px solid black; border-collapse: collapse; text-align: center;">&nbsp;</td>
            <td style="border: 1px solid black; border-collapse: collapse; text-align: center;">&nbsp;</td>
            <td style="border: 1px solid black; border-collapse: collapse; text-align: center;">&nbsp;</td>
        </tr>
        <?php
        }
        ?>
        <tr>
            <th style="border: 1px solid black; border-collapse: collapse; width:30%;" colspan="4">รวมทั้งสิ้น</th>
            <th style="border: 1px solid black; border-collapse: collapse; width:5%;"><?php echo number_format( $price,2) ?> บาท</th>
        </tr>
    </table>


</body>

</html>
<?php
$html = ob_get_contents();
ob_end_clean();
$pdf = new mPDF('th', 'A4', '0', ''); 
$pdf->autoScriptToLang = false;
$pdf->SetDisplayMode('fullpage');
$pdf->WriteHTML($html, 2);
$pdf->Output();
?>