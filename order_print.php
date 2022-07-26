<!doctype html>
<html lang="en">

<head>
    <?php include("inc_head.php"); ?>
</head>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <div class="app-header header-shadow">
            <div class="app-header__logo">
                <div class="logo-src"></div>
                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="app-header__menu">
                <span>
                    <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div>
            <div class="app-header__content">
                <?php include("inc_head_user.php"); ?>
            </div>
        </div>

        <div class="app-main">
            <div class="app-sidebar sidebar-shadow">
                <div class="app-header__logo">
                    <div class="logo-src"></div>
                    <div class="header__pane ml-auto">
                        <div>
                            <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="app-header__mobile-menu">
                    <div>
                        <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
                <div class="app-header__menu">
                    <span>
                        <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                            <span class="btn-icon-wrapper">
                                <i class="fa fa-ellipsis-v fa-w-6"></i>
                            </span>
                        </button>
                    </span>
                </div>
                <div class="scrollbar-sidebar">
                    <?php include("inc_menu.php"); ?>
                </div>
            </div>
            <div class="app-main__outer">
                <div class="app-main__inner">
                    <?php
                    $sql = "SELECT * FROM tb_order WHERE id = '" . @$_GET['id'] . "' ";
                    $rs = mysqli_query($connection, $sql);
                    $row = mysqli_fetch_array($rs);
                    ?>

                   

                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">รายการที่เบิก : <?php echo $row['order_number'] ?></div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table id="" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th style="width:1%" align="center">#</th>
                                                        <th>ชื่ออุปกรณ์</th>
                                                        <th class="text-center">ราคา</th>
                                                        <th class="text-center">จำนวน</th>
                                                        <th class="text-center">รวมทั้งสิ้น</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $sql1 = "SELECT orders.*
                                            ,product.name AS pname
                                            ,product.price AS proprice
                                            ,olist.amount AS oamount
                                            
                                            FROM tb_order AS orders 
                                            LEFT JOIN tb_order_list AS olist ON orders.id = olist.order_id
                                            LEFT JOIN tb_product AS product ON olist.product_id = product.id
                                           
                                            WHERE orders.id = '" . $_GET['id'] . "'
                                            ";
                                                    $rs1 = mysqli_query($connection, $sql1);
                                                    $i = 0;
                                                    $money = 0;
                                                    $amountsum = 0;
                                                    $moneysum = 0;
                                                    while ($row1 = mysqli_fetch_array($rs1)) {
                                                        $i++;
                                                        $money = $row1['oamount'] * $row1['proprice'];
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $i; ?></td>
                                                            <td><?php echo $row1['pname']; ?></td>
                                                            <td align="center"><?php echo number_format($row1['proprice'], 2); ?></td>
                                                            <td align="center"><?php echo $row1['oamount'] ?></td>
                                                            <td align="center"><?php echo number_format($money, 2); ?></td>
                                                        </tr>
                                                    <?php
                                                        $amountsum = $amountsum + $row1['oamount'];
                                                        $moneysum = $moneysum + $money;
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td colspan="3" align="right">รวม</td>
                                                        <td align="center"><?php echo number_format($amountsum); ?></td>
                                                        <td align="center"><?php echo number_format($moneysum, 2); ?> บาท</td>
                                                    </tr>
                                               
                                                </tbody>
                                            </table>

                                               
                                                <div class="col-md-6 mb-4">
                                                <a href="order_print_detail.php?id=<?php echo $row['id'] ?>" target="_blank" class="mt-1 btn btn-info btn-block">ออกใบเบิก</a>
                                                </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                      
                    </div>


                </div>

            </div>
            <!-- <script src="http://maps.google.com/maps/api/js?sensor=true"></script> -->
        </div>
    </div>
    <?php include("inc_script.php"); ?>
    <script language="JavaScript" type="text/JavaScript">
        function check_key_number() {
        use_key=event.keyCode
        if (use_key != 13 && (use_key < 48) || (use_key > 57)) {
        event.returnValue = false;
        }
        }
         
</script>
<script>
    function submit_insert() {
            var money = $('#money').val();
            var formData = new FormData($("#frm_cus")[0]);
            if (money == "") {
                swal({
                    title: 'เกิดข้อผิดพลาด',
                    text: 'กรุณากรอก',
                    type: 'error',
                });
                return false;
            }
            swal({
                title: 'กรุณายืนยันเพื่อทำรายการ',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ยืนยัน',
                cancelButtonText: 'ยกเลิก',
                closeOnConfirm: false
            }, function() {

                $.ajax({
                    type: 'POST',
                    url: 'ajax/calculate/update.php',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    success: function(data) {
                        if (data.result == 1) {
                            swal({
                                title: "ดำเนินการสำเร็จ!",
                                text: "ทำการบันทึกรายการ เรียบร้อย",
                                type: "success",
                            }, function() {
                                location.reload();
                            });
                        }
                    }
                })
            });
        }
</script>
</body>

</html>