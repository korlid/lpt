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
                                    <h5 class="card-title">เพิ่มอุปกรณ์</h5>
                                    <form id="frm_cus" method="post" class="contact-form" onsubmit="return function_check();">

                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <label>รูปภาพ</label><br />
                                                <img id="example_image01" src="public/uploads/no-img.png" class="img-responsive img-thumbnail" style="width:100%; height:300px;"><br />
                                                <span style="font-size:13px; color:red;">ขนาดรูปภาพที่แนะนำ 800x800 px</span>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <div class="custom-file" style="margin-bottom: 5px;">
                                                    <input name="image" id="image" type="file" class="custom-file-input" onchange="readURL01(this);">
                                                    <label for="image" class="custom-file-label"></label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3" style="margin-top:10px;">
                                            <div class="col-md-3">
                                                <label>ประเภท <span style="color:red;">*</span></label>
                                                <select id="category_id" name="category_id" class="form-control">
                                                    <option value="" selected desabled>กรุณาเลือกประเภท</option>
                                                    <?php
                                                    $sql_cate = "SELECT * FROM tb_category WHERE status = 'on' AND delete_status = 0 ORDER BY id desc; ";
                                                    $rs_cate = mysqli_query($connection, $sql_cate);
                                                    while ($cate = mysqli_fetch_array($rs_cate)) {
                                                    ?>
                                                        <option value="<?php echo $cate['id']; ?>"><?php echo $cate['name']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label>ชื่ออุปกรณ์ <span style="color:red;">*</span></label><br />
                                                <input id="name" name="name" class="form-control" autocomplete="off" placeholder="กรุณากรอกชื่ออุปกรณ์">
                                            </div>
                                            <div class="col-md-3">
                                                <label>หน่วยราคา <span style="color:red;">*</span></label><br />
                                                <input type="text" id="unit" name="unit"  class="form-control"  autocomplete="off" placeholder="กรุณากรอกหน่วยราคา">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-2">
                                                <label>ราคา <span style="color:red;">*</span></label><br />
                                                <input type="text" id="price" name="price" style="text-align:right" class="form-control num_text" autocomplete="off" placeholder="กรุณากรอกราคา">
                                            </div>
                                            <div class="col-md-2">
                                                <label>จำนวนที่เบิก <span style="color:red;">*</span></label><br />
                                                <input type="text" id="amount" name="amount" style="text-align:right" class="form-control num_text" value="0" autocomplete="off" placeholder="กรุณากรอกจำนวน">
                                            </div>
                                        </div>



                                        <div class="text-right">
                                            <button type="button" onclick="submit_insert();" class="mt-1 btn btn-primary">บันทึกข้อมูล</button>
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
            var image = $('#image').val();
            var name = $('#name').val();
            var price = $('#price').val();
            var amount = $('#amount').val();
            
            var category_id = $('#category_id').val();
            var formData = new FormData($("#frm_cus")[0]);
            if (image == "") {
                swal({
                    title: 'เกิดข้อผิดพลาด',
                    text: 'กรุณาเพิ่มรูปภาพ',
                    type: 'error',
                });
                return false;
            }
            if (category_id == "") {
                swal({
                    title: 'เกิดข้อผิดพลาด',
                    text: 'กรุณาเลือกประเภท',
                    type: 'error',
                });
                return false;
            }
            if (name == "" || price == "" || amount == "") {
                swal({
                    title: 'เกิดข้อผิดพลาด',
                    text: 'กรุณากรอกข้อมูลที่มี * ให้ครบถ้วน',
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
                    url: 'ajax/product/insert.php',
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
                                window.location.href = "product.php";
                            });
                        }
                    }
                })
            });
        }
    </script>
</body>

</html>