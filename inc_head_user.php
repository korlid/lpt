<div class="app-header-right">
    <div class="header-btn-lg pr-0">
        <div class="widget-content p-0">
            <div class="widget-content-wrapper">
                <div class="widget-content-left">
                    <div class="btn-group">
                        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                            <img width="42" class="rounded-circle" src="public/uploads/user.png" alt="">
                            <i class="fa fa-angle-down ml-2 opacity-8"></i>
                        </a>
                        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                            <a href="logout.php"><button type="button" tabindex="0" class="dropdown-item">ออกจากระบบ</button></a>
                        </div>
                    </div>
                </div>
                <div class="widget-content-left  ml-3 header-user-info">
                    <div class="widget-heading">
                        <?php 
                        $admin_1 = "SELECT * FROM tb_admin WHERE id = '".@$_SESSION['admin_user_id']."' ";
                        $rs_admin_1 = mysqli_query($connection,$admin_1);
                        $row_admin_1 = mysqli_fetch_array($rs_admin_1);
                        ?>
                        <?php echo $row_admin_1['name'] ?>
                    </div>
                    <div class="widget-subheading">
                        ระบบจัดการร้าน
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>