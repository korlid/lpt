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
            <!-- Content -->
            <div class="app-main__outer">
                <div class="app-main__inner">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="main-card mb-3 card">
                                <div class="card-body">
                                    <div class="card-header-tab card-header-tab-animation card-header">
                                        <div class="card-header-title">
                                            รายการสั่งเบิก &nbsp;
                                            
                                        </ul>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="mb-0 table">
                                            <thead>
                                                <tr>
                                                    <th style="width:1%">#</th>
                                                    <th style="width:30%">หมายเลขใบเบิก</th>
                                                    <th class="text-center" style="width:20%">จำนวนรายการ</th>
                                                    <th class="text-center" style="width:20%">ราคาทั้งหมด</th>
                                                    <th class="text-center" style="width:10%">วันที่เพิ่มข้อมูล</th>
                                                    <th class="text-center" style="width:21%"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                $sql = "SELECT * FROM tb_order WHERE admin_id = '".@$_SESSION['admin_user_id']."' ORDER BY id DESC ";
                                                $rs = mysqli_query($connection,$sql);
                                                $i = 0;
                                                while($row = mysqli_fetch_array($rs))
                                                {
                                                    $i++;
                                                ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $row['order_number'] ?></td>
                                                    <td class="text-center"><?php echo $row['amount'] ?> รายการ</td>
                                                    <td class="text-center"><?php echo number_format($row['price'],2) ?> บาท</td>
                                                    <td class="text-center"><?php echo date('d/m/Y',strtotime($row['created'])) ?></td>
                                                    <td class="text-center">
                                                        <a href="order_print.php?id=<?php echo $row['id']; ?>"><button class="btn btn-sm btn-info"><i class="fa fa-edit"></i>ออกใบเบิก</button></a>
                                                        
                                                    </td>
                                                </tr>
                                                <?php
                                                }
                                                ?>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Content -->
            <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
        </div>
    </div>
    <?php include("inc_script.php"); ?>
    <script>
        function Changestatus(id)
        {
            $.ajax({
                type: 'GET',
                url: 'ajax/change_status.php',
                data: {
                    id: id,
                    table: 'tb_admin',
                        },
                dataType: 'json',
                success: function (data) {    
                }
            })
        }

        function delete_item(id)
        {
            swal({
            title: 'กรุณายืนยันเพื่อทำรายการ',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'ยกเลิก',
            confirmButtonText: 'ยืนยัน',
            closeOnConfirm: false
            }, function () {
                $.ajax({
                    type: 'POST',
                    url: 'ajax/delete_status.php',
                    data: {
                        id: id,
                        table: 'tb_admin',
                    },
                    dataType: 'json',
                    success: function(data) 
                    {
                        swal({
                            title: "ดำเนินการสำเร็จ!",
                            text: "ทำการลบข้อมูล เรียบร้อย",
                            type: "success",
                        },function(){
                            location.reload();
                        });
                    }
                })            
            });
        }
    </script>
</body>

</html>