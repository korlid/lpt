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
                        <div class="col-md-6">
                            <div class="main-card mb-3 card">
                                <div class="card-body">
                                    <h5 class="card-title">เพิ่มประเภทอุปกรณ์</h5>
                                    <form id="frm_cus" method="post" class="contact-form" onsubmit="return function_check();">
                                        <div class="position-relative form-group">
                                            <label class="">ชื่อประเภท</label>
                                            <input type="text" id="name" name="name" value="" placeholder="กรุณากรอกชื่อประเภทสินค้า" class="form-control" autocomplete="off">
                                        </div>
                                        <div class="text-right">
                                            <button type="button" onclick="function_check();" class="mt-1 btn btn-primary">บันทึกข้อมูล</button>
                                            <a href="category.php"><button type="button" class="mt-1 btn btn-danger">ยกเลิก</button></a>
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
    <script>
        function function_check() {
            var name = $('#name').val();
            var formData = new FormData($("#frm_cus")[0]);
            if (name == "") {
                swal({
                    title: 'เกิดข้อผิดพลาด',
                    text: 'กรุณากรอกข้อมูลให้ครบถ้วน',
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
                    url: 'ajax/category/insert.php',
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
                                window.location.href = "category.php";
                            });
                        } else if (data.result == 0) {
                            swal({
                                title: "เกิดข้อผิดพลาด !",
                                text: "มีปัญหาทางด้านโปรแกรม กรุณาติดต่อผู้เชี่ยวชาญ !",
                                type: "error",
                            });
                            return false;
                        }
                    }
                })
            });
        }
    </script>
</body>

</html>