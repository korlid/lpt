<?php 

$admin = "SELECT * FROM tb_admin WHERE id = '".@$_SESSION['admin_user_id']."' ";
$rs_admin = mysqli_query($connection,$admin);
$row_admin = mysqli_fetch_array($rs_admin);
?>

<div class="app-sidebar__inner">
<ul class="vertical-nav-menu">
    <li class="app-sidebar__heading">Home</li>
    <li class="<?php if($pagename == "index.php"){ echo 'mm-active'; } ?>">
        <a href="index.php" class="<?php if($pagename == "index.php"){ echo 'mm-active'; } ?>">
            
            หน้าแรก
        </a>
    </li>
    <?php 
    if($row_admin['group_type'] == "admin")
    {
    ?>
        <li class="app-sidebar__heading">จัดการอุปกรณ์ในคลัง</li>
        <li class="<?php if($pagename == "category.php" || $pagename == "product.php"){ echo 'mm-active'; } ?>">
            <a href="#">
               
                อุปกรณ์
                <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
            </a>
            <ul>
                <li>
                    <a href="category.php" class="<?php if($pagename == "category.php"){ echo 'mm-active'; } ?>">
                        <i class="metismenu-icon"></i>
                        ประเภทอุปกรณ์
                    </a>
                </li>
                <li>
                    <a href="product.php" class="<?php if($pagename == "product.php"){ echo 'mm-active'; } ?>">
                        <i class="metismenu-icon"></i>
                        รายการอุปกรณ์
                    </a>
                </li>
            </ul>
        </li>
    <?php 
    }
    ?>
    <li class="app-sidebar__heading">ระบบเบิกอุปกรณ์</li>
    <li>
        <a href="calculate.php" class="<?php if($pagename == "calculate.php"){ echo 'mm-active'; } ?>">
           
            ทำรายการเบิกอุปกรณ์
        </a>
        <a href="order_list.php" class="<?php if($pagename == "order_list.php"){ echo 'mm-active'; } ?>">
            
            สรุปยอดเบิกอุปกรณ์ทั้งหมด
        </a>
    </li>

    <?php 
    if($row_admin['group_type'] == "admin")
    {
    ?>
    <li class="app-sidebar__heading">ผู้ดูแลระบบ</li>
    <li>
        <a href="member.php" class="<?php if($pagename == "member.php"){ echo 'mm-active'; } ?>">
           
            รายการพนักงาน
        </a>
        <a href="report.php" class="<?php if($pagename == "report.php"){ echo 'mm-active'; } ?>">
           
            พิมพ์รายงานการเบิกอุปกรณ์
        </a>
    </li>

    <?php
    }
    ?>
    

</ul>
</div>