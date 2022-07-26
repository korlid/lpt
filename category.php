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
                                            รายการประเภทอุปกรณ์ &nbsp;
                                            <a href="category_create.php" class="btn btn-success "><i class="fa fa-plus"></i> เพิ่มข้อมูล</a>
                                        </ul>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="mb-0 table">
                                            <thead>
                                                <tr>
                                                    <th style="width:1%">#</th>
                                                    <th style="width:45%">ชื่อประเภท</th>
                                                    <th class="text-center" style="width:10%">สถานะ</th>
                                                    <th class="text-center" style="width:15%">วันที่ลงข้อมูล</th>
                                                    <th class="text-center" style="width:21%">จัดการ</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                $sql = "SELECT * FROM tb_category WHERE delete_status = 0 ORDER BY id DESC ";
                                                $rs = mysqli_query($connection,$sql);
                                                $i = 0;
                                                while($row = mysqli_fetch_array($rs))
                                                {
                                                    $i++;
                                                ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $row['name']; ?></td>
                                                    <td>
                                                    <div class="onoffswitch">
                                                        <input type="checkbox" class="onoffswitch-checkbox" 
                                                            <?php if($row['status'] == 'on'){ echo "checked"; } ?> onchange='Changestatus(value);' value="<?php echo $row['id']; ?>" id="StatusReq<?php echo $row['id']; ?>">
                                                            <label class="onoffswitch-label" for="StatusReq<?php echo $row['id']; ?>">
                                                            <span class="onoffswitch-inner"></span>
                                                            <span class="onoffswitch-switch"></span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td class="text-center"><?php echo date('d/m/Y',strtotime($row['created'])); ?></td>
                                                    <td class="text-center">
                                                        <a href="category_edit.php?id=<?php echo $row['id']; ?>"><button class="btn btn-sm btn-info"><i class="fa fa-edit"></i>แก้ไข</button></a>    
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
    
</body>

</html>