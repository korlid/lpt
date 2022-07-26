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
                        <div class="col-md-8">
                            <div class="main-card mb-3 card">
                                <div class="card-body">
                                    <h5 class="card-title">เพิ่มพนักงาน</h5>
                                    <form id="frm_cus" method="post" class="contact-form" onsubmit="return function_check();">

                                        <div class="row mb-3" style="margin-top:10px;">
                                            <div class="col-md-6">
                                                <label>ประเภท <span style="color:red;">*</span></label>
                                                <select id="group_type" name="group_type" class="form-control">
                                                    <option value="" selected desabled>กรุณาเลือกประเภท</option>
                                                    <option value="admin">ผู้ดูแลระบบ</option>
                                                    <option value="staff">พนักงาน</option>
                                                    
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label>ชื่อไอดี <span style="color:red;">*</span></label><br />
                                                <input id="username" name="username" class="form-control" autocomplete="off" placeholder="กรุณากรอกชื่อไอดี">
                                            </div>
                                            <div class="col-md-6">
                                                <label>รหัสผ่าน <span style="color:red;">*</span></label><br />
                                                <input type="password" id="password" name="password" class="form-control" autocomplete="off" placeholder="กรุณากรอกรหัสผ่าน">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label>ชื่อ-นามสกุล <span style="color:red;">*</span></label><br />
                                                <input id="name" name="name" class="form-control" autocomplete="off" placeholder="กรุณากรอกชื่อ-นามสกุล">
                                            </div>
                                            <div class="col-md-6">
                                                <label>ทะเบียนรถ <span style="color:red;">*</span></label><br />
                                                <input id="car" name="car" class="form-control" autocomplete="off" placeholder="กรุณากรอกเลขทะเบียนรถ">
                                            </div>
                                        </div>

                                        <div class="row mb-3" style="margin-top:10px;">
                                            <div class="col-md-6">
                                                <label>สถานะ <span style="color:red;">*</span></label>
                                                <select id="status" name="status" class="form-control">
                                                    <option value="" selected desabled>กรุณาเลือกสถานะ</option>
                                                    <option value="on">เปิดใช้งาน</option>
                                                    <option value="off">ปิดใช้งาน</option>
                                                    
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

        function submit_insert() {
            var group_type = $('#group_type').val();
            var status = $('#status').val();
            var username = $('#username').val();
            var password = $('#password').val();
            var name = $('#name').val();
            var car = $('#car').val();
            var formData = new FormData($("#frm_cus")[0]);
            if (group_type == "" || status == "" || username == "" || password == "" || name == "" || car == "") {
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
                    url: 'ajax/member/insert.php',
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