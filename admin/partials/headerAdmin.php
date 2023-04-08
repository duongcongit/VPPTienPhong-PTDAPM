<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Quản Trị</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="assets/js/script.js"></script>
</head>

<body>
    <div class="container-fluid fixed-top">
        <div class="row">
            <div class="col-md-12 p-0">
                <!-- Navbars start -->
                <nav class="navbar navbar-expand-lg navbar-light">
                    <div class="container-fluid">
                        <i id="btn-menu" class="bi bi-list me-3 fs-2" type="button"></i>
                        <a href="#">
                            <img src="assets/img/logotp.jpg" alt="" class="logo ms-3" style="width:105px">
                        </a>
                        <a class="navbar-brand me-auto ms-3 h5 pt-3" href="index.php">Trang Quản Trị Hệ Thống</a>
                        <a class="navbar-brand ms-auto" href="#"><i class="bi bi-person-workspace me-2"></i><?php echo $_SESSION['adminName'] ?></a>
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
                            <a href="index.php" class="nav-link link-dark">
                                <i class="bi bi-person-circle"></i>
                                <span class="sidebar-item-text">Quản lý quyền KH</span>
                            </a>
                        </li>

                        <li>
                            <a href="employee.php" class="nav-link link-dark">
                                <i class="bi bi-person-circle"></i>
                                <span class="sidebar-item-text">Quản lý nhân viên</span>
                            </a>
                        </li>

                        <li>
                            <a href="products.php" class="nav-link link-dark">
                                <i class="bi bi-basket"></i>
                                <span class="sidebar-item-text">Quản lý sản phẩm</span>
                            </a>
                        </li>

                        <li>
                            <a href="suppliers.php" class="nav-link link-dark">
                                <i class="bi bi-building"></i>
                                <span class="sidebar-item-text">Quản lý nhà cung cấp</span>
                            </a>
                        </li>
 
                        <hr style="width: 100%;">

                        <li>
                            <a href="partials/logout.php" class="nav-link link-dark">
                                <i class="bi bi-box-arrow-right"></i>
                                <span class="sidebar-item-text">Đăng xuất</span>
                            </a>
                        </li>
                    </ul>

                </div>
            </div>
            <!-- Sidebar end -->