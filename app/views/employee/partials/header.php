<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Nhân Viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?php echo SITEURL; ?>/app/views/employee/assets/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="<?php echo SITEURL; ?>/app/views/employee/assets/js/script.js"></script>
</head>

<body>
    <div class="container-fluid fixed-top">
        <div class="row">
            <div class="col-md-12 p-0">
                <!-- Navbars start -->
                <nav class="navbar navbar-expand-lg navbar-light">
                    <div class="container-fluid">
                        <i id="btn-menu" class="bi bi-list me-3 fs-2" type="button"></i>
                        <a href="<?php echo SITEURL; ?>receipt/index">
                            <img src="<?php echo SITEURL; ?>/app/views/employee/assets/img/logotp.jpg" alt="" class="logo ms-3" style="width:105px">
                        </a>
                        <a class="navbar-brand me-auto ms-3 h5 pt-3" href="<?php echo SITEURL; ?>receipt/index">Trang Nhân Viên</a>
                        <!-- <a class="navbar-brand ms-auto" href="#"><i class="bi bi-person-workspace me-2"></i><?php echo $_SESSION['employName'] ?></a> -->
                    </div>
                </nav>
                <!-- Navbars end -->
            </div>
        </div>
    </div>

    <!--  -->

    <!-- Main start -->
    <div class="container-fluid main">
        <div class="row">

            <!-- Sidebar start -->
            <div class="container sidebar sidebar-show">
                <!-- Sidebar menu start-->
                <div class="sidebar-menu">
                    <ul class="">
                        <li>
                            <a href="<?php echo SITEURL; ?>receipt/index" class="nav-link link-dark">
                                <i class="bi bi-receipt"></i>
                                <span class="sidebar-item-text">Quản lý đơn hàng</span>
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo SITEURL ?>receipt/customerCare" class="nav-link link-dark">
                                <i class="bi bi-person-circle"></i>
                                <span class="sidebar-item-text">Chăm sóc khách hàng</span>
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo SITEURL ?>receipt/report" class="nav-link link-dark">
                            <i class="bi bi-card-text"></i>
                                <span class="sidebar-item-text">Báo cáo</span>
                            </a>
                        </li>
                        <hr style="width: 100%;">

                        <li>
                            <a href="<?php echo SITEURL ?>receipt/logout.php" class="nav-link link-dark">
                                <i class="bi bi-box-arrow-right"></i>
                                <span class="sidebar-item-text">Đăng xuất</span>
                            </a>
                        </li>
                    </ul>

                </div>
            </div>
            <!-- Sidebar end -->