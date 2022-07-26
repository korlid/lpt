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

                    <div class="row">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">รายการอุปกรณ์ทั้งหมด</div>
                                        <div class="card-body">
                                            <div class="nav-tabs-boxed">
                                                <ul class="nav nav-tabs" role="tablist">
                                                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#all-1" role="tab" aria-controls="all">ทั้งหมด</a></li>
                                                    <?php 
                                                    $sql_1 = "SELECT * FROM tb_category WHERE delete_status = 0 AND status = 'on' ORDER BY id DESC; ";
                                                    $rs_1 = mysqli_query($connection,$sql_1);
                                                    $i=0;
                                                    while($row_1 = mysqli_fetch_array($rs_1))
                                                    {
                                                        $i++;
                                                    ?>
                                                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#items-<?php echo $i; ?>" role="tab" aria-controls="items"><?php echo $row_1['name'] ?></a></li>
                                                    <?php
                                                    }
                                                    ?>
                                                    <!-- <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#profile-1" role="tab" aria-controls="profile">Profile</a></li>
                                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#messages-1" role="tab" aria-controls="messages">Messages</a></li> -->
                                                </ul>
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="all-1" role="tabpanel">
                                                        <div class="row">
                                                        <?php 
                                                        $sql_3 = "SELECT * FROM tb_product WHERE status = 'on' AND delete_status = 0; ";
                                                        $rs_3 = mysqli_query($connection,$sql_3);
                                                        while($row_3 = mysqli_fetch_array($rs_3))
                                                        {
                                                        ?>
                                                        <div class="col-md-3 mb-3">
                                                            <b><?php echo $row_3['name']; ?></b><br/>
                                                            <span>ราคา <?php echo number_format($row_3['price'],2); ?> <?php echo $row_3['unit']; ?></span><br/>
                                                            <span>จำนวนคงเหลือ <?php echo number_format($row_3['amount']); ?> </span><br/>
                                                            <img src="public/uploads/product/<?php echo $row_3['image'] ?>" style="width:100%; height:200px;" class="img-responsive img-thumbnail">
                                                            <button class="btn btn-block btn-info" onclick="additem('<?php echo $row_3['id']; ?>')"><i class="fa fa-shopping-cart"></i>เลือกอุปกรณ์</button>
                                                        </div>
                                                        <?php
                                                        }
                                                        ?>
                                                        </div>
                                                    </div>
                                                    <?php 
                                                    $sql_2 = "SELECT * FROM tb_category WHERE delete_status = 0 AND status = 'on' ORDER BY id DESC; ";
                                                    $rs_2 = mysqli_query($connection,$sql_2);
                                                    $i=0;
                                                    while($row_2 = mysqli_fetch_array($rs_2))
                                                    {
                                                        $i++;
                                                        
                                                    ?>
                                                    <div class="tab-pane" id="items-<?php echo $i; ?>" role="tabpanel">
                                                       <div class="row">
                                                       <?php 
                                                        $sql_3 = "SELECT * FROM tb_product WHERE category_id = '".$row_2['id']."' AND status = 'on' AND delete_status = 0; ";
                                                        $rs_3 = mysqli_query($connection,$sql_3);
                                                        while($row_3 = mysqli_fetch_array($rs_3))
                                                        {
                                                        ?>
                                                        <div class="col-md-3 mb-3">
                                                            <b><?php echo $row_3['name']; ?></b><br/>
                                                            <span>ราคา <?php echo number_format($row_3['price'],2); ?> <?php echo $row_3['unit']; ?></span><br/>
                                                            <span>จำนวนคงเหลือ <?php echo number_format($row_3['amount']); ?> </span><br/>
                                                            <img src="public/uploads/product/<?php echo $row_3['image'] ?>" style="width:100%; height:200px;" class="img-responsive img-thumbnail">
                                                            <button class="btn btn-block btn-info" onclick="additem('<?php echo $row_3['id']; ?>')"><i class="fa fa-shopping-cart"></i>เลือกอุปกรณ์</button>
                                                        </div>

                                                     


                                                        <?php
                                                        }
                                                        ?>
                                                       </div>
                                                        
                                                    </div>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">

                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <button class="btn btn-block btn-danger">รายการอุปกรณ์</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 col-xl-12">
                                            <div class="widget-content">
                                                <div class="widget-content-wrapper">
                                                    <div class="widget-content-left">
                                                        <div class="widget-heading">ชื่ออุปกรณ์(จำนวน)</div>
                                                    </div>
                                                    <div class="widget-content-right">
                                                        <div class="widget-heading">ราคา</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $sql_cart = "SELECT * FROM tb_cart WHERE admin_id = '".@$_SESSION['admin_user_id']."' ";
                                    $rs_cart = mysqli_query($connection,$sql_cart);
                                    $amount = 0;
                                    $price = 0;
                                    while($row_cart = mysqli_fetch_array($rs_cart))
                                    {
                                        $sql_cart_pro = "SELECT * FROM tb_product WHERE id = '".$row_cart['product_id']."' ";
                                        $rs_cart_pro = mysqli_query($connection,$sql_cart_pro);
                                        $row_cart_pro = mysqli_fetch_array($rs_cart_pro);

                                        $sql_cate_pro = "SELECT * FROM tb_category WHERE id = '".$row_cart_pro['category_id']."' ";
                                        $rs_cete_pro = mysqli_query($connection,$sql_cate_pro);
                                        $row_cate_pro = mysqli_fetch_array($rs_cete_pro);
                                    ?>
                                        <div class="row">
                                            <div class="col-lg-12 col-xl-12">
                                                <div class="widget-content">
                                                    <div class="widget-content-wrapper">
                                                        <div class="widget-content-left">
                                                            <div class="widget-heading"><?php echo $row_cart_pro['name'] ?><span>(<?php echo $row_cart['amount']; ?>)</span></div>
                                                            <div class="widget-subheading"><?php echo $row_cate_pro['name'] ?> x <span><?php echo number_format($row_cart['price_unit'],2) ?></span></div>
                                                        </div>
                                                        <div class="widget-content-right">
                                                            <div class="widget-numbers text-success">
                                                                <!-- <input min="0" data-id="<?php echo $row_cart['id']; ?>" type="number" class="qty_sub" id="amount_id_<?php echo $row_cart['id']; ?>" name="amount_id_<?php echo $row_cart['id']; ?>" value="<?php echo $row_cart['amount']; ?>" style="width:100px; text-align:right">
                                                                <input min="0" data-id="<?php echo $row_cart['id']; ?>" type="number" id="old_amount_id_<?php echo $row_cart['id']; ?>" hidden name="old_amount_id_<?php echo $row_cart['id']; ?>" value="<?php echo $row_cart['amount']; ?>">
                                                                  -->
                                                                  <!-- <?php echo $row_cart['amount']; ?> -->
                                                                <button type="button" class="btn btn-xs btn-success qty_sub" data-id="<?php echo $row_cart['id']; ?>">+</button>
                                                                <button type="button" class="btn btn-xs btn-info qty_minus" data-id="<?php echo $row_cart['id']; ?>">-</button>
                                                                <!-- <span style="font-size:20px"><input min="0" data-id="<?php echo $row_cart['id']; ?>" type="number" class="qty_sub" id="amount_id_<?php echo $row_cart['id']; ?>" name="amount_id_<?php echo $row_cart['id']; ?>" value="<?php echo $row_cart['amount']; ?>" style="width:100px; text-align:right"> x</span> <span><?php echo number_format($row_cart['price_unit'],2) ?></span> -->
                                                                <button class="btn btn-xs btn-danger" style="font-size:10px;" onclick="cancelall('<?php echo $row_cart['id'];?>');"><i class="fa fa-trash"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr />
                                            </div>
                                        </div>
                                    <?php
                                        $amount = $amount + $row_cart['amount'];
                                        $price = $price + $row_cart['price_sum'];
                                    }
                                    ?>
                                    <div class="row">
                                        <div class="col-lg-12 col-xl-12">
                                            <div class="widget-content">
                                                <div class="widget-content-wrapper">
                                                    <div class="widget-content-left">
                                                        <div class="widget-heading">รวมทั้งสิ้น</div>
                                                    </div>
                                                    <div class="widget-content-right">
                                                        <div class="widget-heading">จำนวน : <?php echo $amount; ?> รายการ | ราคา : <?php echo number_format($price,2); ?> บาท</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <button onclick="submitcart();" class="btn btn-block btn-success">คำนวนเงิน</button>
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
    <script>
        
        $('.qty_minus').click(function(){
			var id = $(this).attr('data-id');
            
			$.ajax({
                type: 'POST',
                url: 'ajax/member/cart_update_minus.php',
                data: {
                    cart_id: id,
                },
                dataType: 'json',
                success: function(data) 
				{
					if(data.result == 4)
                    {
                        swal({
                        title: "เกิดข้อผิดพลาด!",
                        text: "อุปกรณ์ชนิดนี้หมด",
                        type: "error",
                        },function(){
                            location.href = "calculate.php";
                        });
                    }
                    else
                    {
                        location.reload();
                    }
                }
            });
		});
    $('.qty_sub').click(function(){
			var id = $(this).attr('data-id');
            
			$.ajax({
                type: 'POST',
                url: 'ajax/member/cart_update_plus.php',
                data: {
                    cart_id: id,
                },
                dataType: 'json',
                success: function(data) 
				{
					if(data.result == 4)
                    {
                        swal({
                        title: "เกิดข้อผิดพลาด!",
                        text: "อุปกรณ์ชนิดนี้หมด",
                        type: "error",
                        },function(){
                            location.href = "calculate.php";
                        });
                    }
                    else
                    {
                        location.reload();
                    }
                }
            });
		});
        function cancelall(id)
        {
            swal({
            title: 'กรุณายืนยันเพื่อยกเลิกรายการเบิก',
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
                    url: 'ajax/cart/cancel.php',
                    data: {
                        id: id,
                        table: 'tb_cart',
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
        function additem(id) 
        {
            $.ajax({
                type: 'POST',
                url: 'ajax/cart/additem.php',
                data: {id:id},
                dataType: 'json',
                success: function(data) 
                {
                    if(data.result == 4)
                    {
                        swal({
                        title: "เกิดข้อผิดพลาด!",
                        text: "อุปกรณ์ชนิดนี้หมด",
                        type: "error",
                        },function(){
                            location.href = "calculate.php";
                        });
                    }
                    else
                    {
                        location.reload();
                    }
                    
                }
            })
        }
        function submitcart(id)
        {
            swal({
            title: 'ยืนยันการเบิกอุปกรณ์',
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
                    url: 'ajax/cart/submit_cart.php',
                    data: {
                    },
                    dataType: 'json',
                    success: function(data) 
                    {
                        if(data.result == 1)
                        {
                            swal({
                            title: "ดำเนินการสำเร็จ!",
                            text: "ทำการสั่งเบิก เรียบร้อย",
                            type: "success",
                            },function(){
                                location.href = "order_print.php?id="+data.iduse;
                            });
                        }
                        
                        else
                        {
                            swal({
                            title: "เกิดข้อผิดพลาด!",
                            text: "กรุณาเลือกอุปกรณ์ก่อน",
                            type: "error",
                            },function(){
                                location.href = "calculate.php";
                            });
                        }
                    }
                })            
            });
        }
    </script>
</body>

</html>