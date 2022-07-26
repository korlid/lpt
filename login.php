<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>ระบบจัดการหลังร้าน</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">
    <link href="public/main.css" rel="stylesheet">
    <link rel="stylesheet" href="public/cusmike/sweetalert.css">
    
</head>
<style>
    .Absolute-Center {
        margin: auto;
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
    }
</style>

<body>
    <div class="container mt-5">

        <div class="row justify-content-center" style="margin-top:20%">
            <div class="col-md-6 ">
                <div class="card">
                    <div class="card-body">

                        <form id="frm_cus" method="post" class="contact-form" onsubmit="return function_check();">
                            <div class="row mb-2">
                                <div class="col-md-12 text-center">
                                    <b>เข้าสู่ระบบ</b>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-12 mb-2">
                                    <b>ไอดี</b>
                                    <input type="text" id="username" name="username" value="" class="form-control" placeholder="กรอกชื่อผู้ใช้งาน" autocomplete="off">
                                </div>
                                <div class="col-md-12 mb-2">
                                    <b>รหัสผ่าน</b>
                                    <input type="password" id="password" name="password" value="" class="form-control" placeholder="กรอกรหัสผ่าน" autocomplete="off">
                                </div>

                                <div class="col-md-12 mb-2 text-right">
                                    <button type="button" onclick="loginsubmit();" class="btn btn-success checkvalue">เข้าสู่ระบบ</button>
                                    <a href="index.php"><button type="button" class="btn btn-danger">ยกเลิก</button></a>
                                </div>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>


    </div>
    <?php include("inc_script.php"); ?>
    <script>
        function loginsubmit() {
            var username = $('#username').val();
            var password = $('#password').val();
            if (username == "" || password == "") {
                swal({
                    title: 'เกิดข้อผิดพลาด',
                    text: 'กรุณากรอกชื่อและรหัสผ่าน',
                    type: 'error'
                });
                return false;
            }

            $.ajax({
                type: 'POST',
                url: 'ajax/auth/check_login.php',
                data: {
                    username: username,
                    password: password,
                },
                dataType: 'json',
                success: function(data) {
                    if (data.result == 0) {
                        swal({
                            title: "เกิดข้อผิดพลาด",
                            text: "ไม่มีชื่อผู้ใช้งานนี้ในระบบ",
                            type: "error",
                        });
                    } else if (data.result == 1) {
                        swal({
                            title: "ดำเนินการสำเร็จ",
                            text: "เข้าสู่ระบบเรียบร้อย",
                            type: "success",
                        }, function() {
                            location.href = "index.php";
                        });
                    } else if (data.result == 2) {
                        swal({
                            title: "เกิดข้อผิดพลาด",
                            text: "รหัสผ่านผิด กรุณากรอกใหม่อีกครั้ง",
                            type: "error",
                        });
                        return false;
                    }
                }
            })
        }
    </script>
</body>

</html>