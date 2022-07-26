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
                        <div class="col-md-4">
                            <div class="main-card mb-3 card">
                                <div class="card-body">
                                    <h5 class="card-title">แก้ไขพนักงาน</h5>
                                    <?php
                                    $sql = "SELECT * FROM tb_admin WHERE id = '".$_GET['id']."' ";
                                    $rs = mysqli_query($connection,$sql);
                                    $row = mysqli_fetch_array($rs);
                                    ?>
                                    <form id="frm_cus" method="post" class="contact-form" onsubmit="return function_check();">
                                        <input id="id" name="id" value="<?php echo $row['id']; ?>" hidden>
                                        

                                        <div class="row mb-3" style="margin-top:10px;">
                                            <div class="col-md-6">
                                                <label>ประเภท <span style="color:red;">*</span></label>
                                                <select id="group_type" name="group_type" class="form-control">
                                                    <option value="" selected desabled>กรุณาเลือกประเภท</option>
                                                    <option value="admin" <?php if($row['group_type'] == "admin"){ echo 'selected'; } ?>>ผู้ดูแลระบบ</option>
                                                    <option value="staff" <?php if($row['group_type'] == "staff"){ echo 'selected'; } ?>>พนักงาน</option>
                                                    
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label>ชื่อผู้ใช้งาน <span style="color:red;">*</span></label><br />
                                                <input id="username" name="username" readonly="on" value="<?php echo $row['username'] ?>" class="form-control" autocomplete="off" placeholder="กรุณากรอกชื่อผู้ใช้งาน">
                                            </div>
                                            <div class="col-md-6">
                                                <label>รหัสผ่าน <span style="color:red;">*</span></label><br />
                                                <input type="password" id="password" name="password" class="form-control" autocomplete="off" placeholder="กรุณากรอกรหัสผ่าน">
                                            </div>
                                        </div>

                                        <div class="row mb-3" style="margin-top:10px;">
                                            <div class="col-md-6">
                                                <label>สถานะ <span style="color:red;">*</span></label>
                                                <select id="status" name="status" class="form-control">
                                                    <option value="" selected desabled>กรุณาเลือกสถานะ</option>
                                                    <option value="on" <?php if($row['status'] == "on"){ echo 'selected'; } ?>>เปิดใช้งาน</option>
                                                    <option value="off" <?php if($row['status'] == "off"){ echo 'selected'; } ?>>ปิดใช้งาน</option>
                                                    
                                                </select>
                                            </div>
                                        </div>

                                        <div class="text-right">
                                            <button type="button" onclick="submit_insert();" class="mt-1 btn btn-primary">บันทึกข้อมูล</button>
                                            <a href="member.php"><button type="button" class="mt-1 btn btn-danger">ยกเลิก</button></a>
                                        </div>



                                    </form>
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
    <script type="text/javascript">
        $(function() {

            $(".num_text").on("keypress", function(e) {

                var code = e.keyCode ? e.keyCode : e.which;

                if (code > 57) {
                    return false;
                } else if (code < 48 && code != 8) {
                    return false;
                }

            });
        });

        function readURL01(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {

                    console.log(this.width);
                    $('#example_image01').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        function submit_insert() {
            var group_type = $('#group_type').val();
            var status = $('#status').val();
            var formData = new FormData($("#frm_cus")[0]);
            if (group_type == "" || status == "") {
                swal({
                    title: 'เกิดข้อผิดพลาด',
                    text: 'กรุณากรอกข้อมูลให้ครบถ้วนทั้งหมด',
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
                    url: 'ajax/member/update.php',
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
                                window.location.href = "member.php";
                            });
                        }
                    }
                })
            });
        }
    </script>
</body>

</html>