<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link rel="icon" type="image/x-icon" href="../assets/images/favicon_io/favicon-32x32.png">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="app/assets/css/style.css">
</head>

<body>

    <!-- Header -->
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
                        <a class="navbar-brand" href=""><img src="app/assets/images/logo.png" alt="" style="width: 150px;"></a>
                    </div>
                    <div class="search-bar d-none d-md-flex m-auto">
                        <form class="d-flex align-items-center">
                            <input class="me-2 search-box ps-3" placeholder="Tìm kiếm" aria-label="Search">
                            <i class="bi bi-search text-info fs-5 search-button" type="submit"></i>
                        </form>
                    </div>
                    <div class="account d-none d-md-flex ms-auto">
                        <i class="bi bi-person text-info fs-3"></i>
                    </div>
                    <div class="cart ms-4">
                        <a href="./customer/cart.php"><i class="bi bi-cart2 text-info fs-3"></i></a>
                    </div>
                </div>
            </nav>
        </div>

        <!-- <hr class="p-0 m-0 m-auto d-none d-md-flex" style="width: 95%;"> -->

        <!-- Menu -->
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
                                <a class="nav-link" href="#">Thiết bị <i class="bi bi-star text-info fs-6 ms-3"></i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Giấy <i class="bi bi-star text-info fs-6 ms-3"></i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Bút viết <i class="bi bi-star text-info fs-6 ms-3"></i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Lưu trữ <i class="bi bi-star text-info fs-6 ms-3"></i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Mực <i class="bi bi-star text-info fs-6 ms-3"></i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Dụng cụ văn phòng</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>

    </div>

    <!-- Main -->
    <div class="container-fluid main p-0">
        <div class="row">
            <!-- Banner 1 -->
            <div class="col-md-12 mb-5 banner p-0">
                <img src="app/assets/images/banner-bg.jpg" alt="">
                <div class="text centered banner-text d-flex align-items-center justify-content-center">
                    <div class="text-inner text-center">
                        <h3>Văn phòng phẩm </h3>
                        <h1>TIỀN PHONG</h1>
                        <p>Chuyên bán lẻ các dụng cụ, thiết bị văn phòng. Nhận cung cấp cho các công ty, trường học với
                            số lượng lớn, đảm bảo hàng uy tín, chất lượng</p>
                    </div>
                </div>
            </div>

            <div class="col-md-12 mb-5 shadow">
                <div class="row" style="max-width: 1200px; margin: auto;">
                    <div class="col row mt-2">
                        <div class="col-1 me-3"><i class="bi bi-shield-fill-check text-info fs-3"></i></div>
                        <div class="col">
                            <h5 style="font-weight: bold;">Chất lượng tốt nhất</h5>
                            <p style="font-size: small;">Chuyên bán lẻ các dụng cụ, thiết bị văn phòng.</p>
                        </div>
                    </div>
                    <div class="col row mt-2">
                        <div class="col-1 me-3"><i class="fa-solid fa-hand-holding-dollar text-info fs-3"></i></div>
                        <div class="col">
                            <h5 style="font-weight: bold;">Giá cả phù hợp</h5>
                            <p style="font-size: small;">Chuyên bán lẻ các dụng cụ, thiết bị văn phòng.</p>
                        </div>
                    </div>
                    <div class="col row mt-2">
                        <div class="col-1 me-3"><i class="fa-solid fa-pen-ruler text-info fs-3"></i></div>
                        <div class="col">
                            <h5 style="font-weight: bold;">Sản phẩm đa dạng</h5>
                            <p style="font-size: small;">Chuyên bán lẻ các dụng cụ, thiết bị văn phòng.</p>
                        </div>
                    </div>
                    <div class="col row mt-2">
                        <div class="col-1 me-3"><i class="fa-solid fa-leaf text-info fs-3"></i></div>
                        <div class="col">
                            <h5 style="font-weight: bold;">Thân thiện môi trường</h5>
                            <p style="font-size: small;">Chuyên bán lẻ các dụng cụ, thiết bị văn phòng.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="content ps-5">
                <div class="col-md-12">
                    <div class="col-md-12 d-flex justify-content-between">
                        <h3>Sản phẩm bán chạy</h3>
                        <a href="" class="text-info" style="text-decoration: none;font-weight: bold;">
                            Xem tất cả
                            <i class="fa-solid fa-angles-right"></i>
                        </a>
                    </div>
                    <div class="col-md-12 row d-flex justify-content-evenly">

                        <?php
                        foreach ($productsBestSold as $product) {
                        ?>
                            <!-- Items -->
                            <div class="pb-3 items-card col-sm-5 col-md-3" style="width: 17rem;">


                                <div class="col-md-12 product-image">
                                    <a href="product/detail/<?php echo $product['productID']; ?>" class="">
                                        <img src="<?php echo $product['image1']; ?>" class="card-img-top" alt="...">
                                    </a>
                                </div>

                                <hr class="p-0 m-0 mb-4 m-auto d-none d-md-flex" style="width: 50%;">
                                <div class="d-flex justify-content-center">
                                    <a href="product/detail/<?php echo $product['productID']; ?>">
                                        <h6 class="card-title"><?php echo $product['productName']; ?></h6>
                                    </a>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <strong><?php echo $product['price']; ?></strong>
                                </div>
                                <div class="d-flex justify-content-center pt-3">
                                    <!-- rgb(13,202,240)
                                rgb(0,179,160) -->
                                    <button class="btn btn-info text-light" style="background-color:  rgb(58, 160, 180);">Thêm vào giỏ</button>
                                </div>
                            </div>

                        <?php
                        }
                        ?>


                    </div>
                </div>

            </div>

            <!-- Banner 2 -->
            <div class="col-md-12 mb-5 banner p-0">
                <img src="app/assets/images/office-banner.jpg" alt="">
                <div class="text centered banner-2-text d-flex align-items-center justify-content-center">
                    <div class="text-inner text-center text-light">
                        <h3>Văn phòng phẩm </h3>
                        <h1>TIỀN PHONG</h1>
                        <p>Chuyên bán lẻ các dụng cụ, thiết bị văn phòng. Nhận cung cấp cho các công ty, trường học với
                            số lượng lớn, đảm bảo hàng uy tín, chất lượng</p>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="content ps-5">
                <div class="col-md-12">
                    <div class="col-md-12 d-flex justify-content-between">
                        <h3>Thiết bị</h3>
                        <a href="" class="text-info" style="text-decoration: none;font-weight: bold;">
                            Xem tất cả
                            <i class="fa-solid fa-angles-right"></i>
                        </a>
                    </div>
                    <div class="col-md-12 row d-flex justify-content-evenly">

                        <?php
                        foreach ($productsCatThietBi as $product) {
                        ?>
                            <!-- Items -->
                            <div class="pb-3 items-card col-sm-5 col-md-3" style="width: 17rem;">
                                <div class="col-md-12 product-image">
                                    <a href="product/detail/<?php echo $product['productID']; ?>">
                                        <img src="<?php echo $product['image1']; ?>" class="card-img-top" alt="...">
                                    </a>
                                </div>

                                <hr class="p-0 m-0 mb-4 m-auto d-none d-md-flex" style="width: 50%;">
                                <div class="d-flex justify-content-center">
                                    <a href="product/detail/<?php echo $product['productID']; ?>">
                                        <h6 class="card-title"><?php echo $product['productName']; ?></h6>
                                    </a>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <strong><?php echo $product['price']; ?></strong>
                                </div>
                                <div class="d-flex justify-content-center pt-3">
                                    <!-- rgb(13,202,240)
                                rgb(0,179,160) -->
                                    <button class="btn btn-info text-light" style="background-color:  rgb(58, 160, 180);">Thêm vào giỏ</button>
                                </div>
                            </div>

                        <?php
                        }
                        ?>


                    </div>
                </div>

            </div>


        </div>
    </div>

    <hr class="p-0 m-0 m-auto d-none d-md-flex" style="width: 95%;">

    <!-- Footer -->
    <div class="container-fluid footer mt-4 p-0">
        <footer class="text-center text-lg-start text-dark" style="background-color: #ECEFF1">
            <!-- Section: Social media -->
            <section class="d-flex justify-content-between p-4 text-white" style="background-color: rgb(58, 160, 180)">
                <!-- Left -->
                <div class="me-5">
                    <span>Kết nối với chúng tôi:</span>
                </div>
                <!-- Left -->

                <!-- Right -->
                <div>
                    <a href="" class="text-white me-4">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="" class="text-white me-4">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="" class="text-white me-4">
                        <i class="fab fa-google"></i>
                    </a>
                    <a href="" class="text-white me-4">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="" class="text-white me-4">
                        <i class="fab fa-linkedin"></i>
                    </a>
                    <a href="" class="text-white me-4">
                        <i class="fab fa-github"></i>
                    </a>
                </div>
                <!-- Right -->
            </section>
            <!-- Section: Social media -->

            <!-- Section: Links  -->
            <section class="">
                <div class="container text-center text-md-start mt-5">
                    <!-- Grid row -->
                    <div class="row mt-3">
                        <!-- Grid column -->
                        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                            <!-- Content -->
                            <h6 class="text-uppercase fw-bold">Công ty TNHH VPP Tiền Phong</h6>
                            <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
                            <p>
                                Chuyên bán lẻ các dụng cụ, thiết bị văn phòng. Nhận cung cấp cho các công ty, trường học
                                với số lượng lớn, đảm bảo hàng uy tín, chất lượng
                            </p>
                        </div>
                        <!-- Grid column -->

                        <!-- Grid column -->
                        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                            <!-- Links -->
                            <h6 class="text-uppercase fw-bold">Sản phẩm</h6>
                            <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
                            <p>
                                <a href="#!" class="text-dark">Thiết bị</a>
                            </p>
                            <p>
                                <a href="#!" class="text-dark">Lưu trữ</a>
                            </p>
                        </div>
                        <!-- Grid column -->

                        <!-- Grid column -->
                        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                            <!-- Links -->
                            <h6 class="text-uppercase fw-bold">Menu</h6>
                            <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
                            <p>
                                <a href="#!" class="text-dark">Trang chủ</a>
                            </p>
                            <p>
                                <a href="#!" class="text-dark">Tài khoản</a>
                            </p>
                            <p>
                                <a href="#!" class="text-dark">Giới thiệu</a>
                            </p>
                            <p>
                                <a href="#!" class="text-dark">Liên hệ</a>
                            </p>
                        </div>
                        <!-- Grid column -->

                        <!-- Grid column -->
                        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                            <!-- Links -->
                            <h6 class="text-uppercase fw-bold">Liên hệ</h6>
                            <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
                            <p><i class="fas fa-home mr-3"></i> Số 175 Tây Sơn, Đống Đa, Hà Nội</p>
                            <p><i class="fas fa-envelope mr-3"></i> vpptienphong@gmail.com</p>
                            <p><i class="fas fa-phone mr-3"></i> 0240 6354 8795</p>
                            <p><i class="fas fa-print mr-3"></i> 0236 4789 5398</p>
                        </div>
                        <!-- Grid column -->
                    </div>
                    <!-- Grid row -->
                </div>
            </section>
            <!-- Section: Links  -->

            <!-- Copyright -->
            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
                © 2023 Copyright:
                <a class="text-dark" href="https://mdbootstrap.com/">Group 8 - 61TH3</a>
            </div>
            <!-- Copyright -->
        </footer>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>