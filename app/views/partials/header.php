<?php
require_once _DIR_ROOT . "/app/config/constants.php";
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Văn phòng phẩm Tiền Phong</title>
    <link rel="icon" type="image/x-icon" href="<?php echo SITEURL; ?>app/assets/images/favicon-32x32.png">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?php echo SITEURL; ?>/app/assets/css/style.css">
    <script src="<?php echo SITEURL; ?>/app/assets/js/jquery-3.6.4.min.js"></script>
    <script src="<?php echo SITEURL; ?>/app/assets/js/script.js"></script>
    <script>
        const SITEURL = "<?php echo SITEURL; ?>";
    </script>
</head>

<body>

    <!-- Modal add to cart success -->
    <div class="modal fade modal-success" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div>
                <div class="mt-5" style="height: fit-content;background-color: transparent;">
                    <i class="bi bi-check-circle text-info" style="font-size: 50px;"></i>
                </div>
                <p class="mt-0 fs-5" id="modal-success-message">Thành công</p>
            </div>
        </div>
    </div>

    <!-- Modal add to cart fail -->
    <div class="modal fade modal-fail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div>
                <div class="mt-5" style="height: fit-content;background-color: transparent;">
                    <i class="bi bi-x-circle text-danger" style="font-size: 50px;"></i>
                </div>
                <p class="mt-0 fs-5" id="modal-fail-message">Lỗi</p>
            </div>
        </div>
    </div>

    <!-- Start Header -->
    <div class="container-fluid header p-0 bg-light">

        <div class="container-fluid taskbar shadow">
            <!--  -->
            <nav class="navbar navbar-expand-lg navbar-light row">
                <div class="container-fluid col-md-12">
                    <div class="button-menu d-flex d-md-none">
                        <i class="navbar-toggler bi bi-list" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        </i>
                    </div>
                    <div class="logo">
                        <a class="navbar-brand" href="<?php echo SITEURL; ?>"><img src="<?php echo SITEURL; ?>app/assets/images/logo.png" alt="" style="width: 150px;"></a>
                    </div>
                    <div class="search-bar d-none d-md-flex m-auto">
                        <form class="d-flex align-items-center">
                            <input class="me-2 search-box ps-3" placeholder="Tìm kiếm" aria-label="Search">
                            <i class="bi bi-search text-info fs-5 search-button" type="submit"></i>
                        </form>
                    </div>
                    <div class="account d-none d-md-flex ms-auto">
                        <a href="<?php echo SITEURL; ?>customer/login">
                            <i class="bi bi-person text-info fs-3"></i>
                        </a>

                    </div>
                    <div class="cart ms-4">
                        <a href="<?php echo SITEURL; ?>customer/cart"><i class="bi bi-cart2 text-info fs-3"></i></a>
                    </div>
                </div>
            </nav>
        </div>

        <!-- <hr class="p-0 m-0 m-auto d-none d-md-flex" style="width: 95%;"> -->

        <!-- Start Menu -->
        <div class="container-fluid menu-bar p-0 pt-2 pb-2">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container-fluid col-md-12">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <div class="search-bar d-flex d-md-none m-auto">
                            <form class="d-flex align-items-center">
                                <input class="me-2 search-box search-box-sidemenu ps-3" placeholder="Tìm kiếm" aria-label="Search">
                                <i class="bi bi-search text-info fs-5 search-button" type="submit"></i>
                            </form>
                        </div>
                        <ul class="navbar-nav m-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo SITEURL; ?>category/category/giay-in-an">Giấy <i class="bi bi-star text-info fs-6 ms-3"></i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo SITEURL; ?>category/category/but">Bút viết <i class="bi bi-star text-info fs-6 ms-3"></i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo SITEURL; ?>category/category/luu-tru">Lưu trữ <i class="bi bi-star text-info fs-6 ms-3"></i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo SITEURL; ?>category/category/thiet-bi">Thiết bị <i class="bi bi-star text-info fs-6 ms-3"></i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo SITEURL; ?>category/category/dung-cu">Dụng cụ văn phòng</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <!-- End Menu -->

    </div>
    <!-- End Header -->