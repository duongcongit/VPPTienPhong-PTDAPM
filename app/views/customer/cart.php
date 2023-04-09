<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
    <link rel="icon" type="image/x-icon" href="../../assets/images/favicon_io/favicon-32x32.png">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>

<body>
    <!-- Header -->
    <div class="container-fluid header p-0 bg-light">

        <div class="container-fluid taskbar shadow">
            <!--  -->
            <nav class="navbar navbar-expand-lg navbar-light row">
                <div class="container-fluid col-md-12">
                    <div class="button-menu d-flex d-md-none">
                        <i class="navbar-toggler bi bi-list" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                        </i>
                    </div>
                    <div class="logo">
                        <a class="navbar-brand" href="../index.php"><img src="../../assets/images/logo.png" alt="" style="width: 150px;"></a>
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
                        <i class="bi bi-cart2 text-info fs-3"></i>
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
                                <input class="me-2 search-box search-box-sidemenu ps-3" placeholder="Tìm kiếm"
                                    aria-label="Search">
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


    <div class="main container-fluid">
        <div class="row" id="cart-view">
            <div class="col-md-12 mt-4 fs-1">
                <p class="bi bi-cart3 text-muted">Giỏ hàng</p>
            </div>

            <!--  -->

            <div class="col-md-12 col-lg-9 mb-5">
                <div class="prod-cart-info mb-4 col-md-12 bg-light d-flex align-items-center px-3 py-2">
                    <div style="width: 40%;"><input id="btn-check-all-cart" class="me-1 form-check-input" type="checkbox" style="cursor: pointer;">Tất cả (0 sản phẩm)</div>
                    <div style="width: 20%;">Đơn giá</div>
                    <div style="width: 20%;">Số lượng</div>
                    <div style="width: 20%;">Thành tiền</div>
                    <i class="bi bi-trash text-muted fs-4 btn-clear-cart" type="button"></i>
                </div>
                <!-- Shop -->
                    <div class="prod-cart-info col-md-12 bg-light px-3 py-2 mb-4">
                        <div class="col-md-12"><input class="btn-check-shop me-1 form-check-input" data-seller_id="" data-num_prod="" type="checkbox" style="cursor: pointer;">
                            <i class="bi bi-shop m-1"></i><strong>VPP Tiền Phong</strong>
                        </div>
                        <!-- Product -->
                            <div class="prod-info mb-0 mt-3 col-md-12 bg-light d-flex d-flex align-items-center px-3 py-2">
                                <div style="width: 40%;" class="mb-4 d-flex align-items-center">
                                    <input class="btn-check-product me-1 form-check-input" type="checkbox" style="cursor: pointer;" data-seller_id="" data-prodid="" value="">
                                    <img src="../../assets/images/products/bam_lo.jpg" alt="" class="product-avatar-list" style="width: 70px;">
                                    <span class="quick-produc-name ms-2 pe-3">Bấm kim 50LA - 210 tờ</span>
                                </div>
                                <div class="mb-4" style="width: 20%;"><u class="ms-1">90.000đ</u></div>
                                <div style="width: 20%;">
                                    <ul class="pagination">
                                        <li class="page-item">
                                            <a class="page-link bi bi-dash-lg btn-decrease-cart" type="button" data-prodid="" data-prod_price="" data-prod_stock=""></a>
                                        </li>
                                        <li class="page-item">
                                            <input type="text" class="page-link px-2 text-dark input-quantity-cart" autocomplete="off" data-prodid="" data-prod_price="" data-prod_stock="" value="" style="width: 40px;">
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link bi-plus-lg btn-increase-cart" type="button" data-prodid="" data-prod_price="" data-prod_stock=""></a>
                                        </li>
                                    </ul>
                                </div>
                                <div style="width: 20%;" class="text-danger mb-4 amount" data-prodid="" data-amount="">
                                    <u>đ</u>
                                </div>
                                <div class="mb-4"><i type="button" class="bi bi-trash text-muted fs-5 btn-remove-cart" data-prodid=""></i></div>
                            </div>
                        <!-- Product -->
                    </div>
                <!-- Shop -->
            </div>
            <!--  -->
            <div class="col-md-12 col-lg-3">
                <div class="col-md-12 bg-light px-3">
                    <div class="col-md-12 d-flex justify-content-between pt-2">
                        <p class="text-muted">Giao tới</p>
                        <a href="#" class="text-decoration-none">Thay đổi</a>
                    </div>
                    <div class="col-md-12">
                        <strong></strong>
                        <p class="text-muted mt-1 pb-4"></p>
                    </div>
                </div>
                <div class="col-md-12 bg-light px-3 mb-3">
                    <div class="col-md-12 d-flex justify-content-between pt-2">
                        <p class="">Khuyến mãi</p>
                        <p class="text-muted">Có thể chọn(0) <i type="button" class="bi bi-info-circle"></i></p>
                    </div>
                    <div class="col-md-12 d-flex justify-content-center pb-4">
                        <h3 class="text-muted">Không áp dụng</h3>
                    </div>
                </div>
                <div class="col-md-12 bg-light px-3 mb-3">
                    <div class="col-md-12 d-flex justify-content-between pt-2">
                        <p>Đã chọn: </p>
                        <p class="number-product-checked">0 (Sản phẩm)</p>
                    </div>
                    <hr>
                    <div class="col-md-12 d-flex justify-content-between pt-2">
                        <h4>Tạm tính: </h4>
                        <div>
                            <h4 class="text-danger d-flex justify-content-end total-price">0<u class="ms-1">đ</u></h4>
                            <p class="fs-6">(Đã bao gồm VAT nếu có)</p>
                        </div>
                    </div>
                </div>
                <p id="order-help" class="col-md-12 text-danger d-flex justify-content-center d-none" style="font-weight: 500;">(!) Chưa chọn sản phẩm nào.</p>
                <a href="#" id="btn-order" class="btn btn-danger col-md-12 py-2 mb-3">
                    <h4 class="mt-1">Đặt hàng</h4>
                </a>
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
                            <hr class="mb-4 mt-0 d-inline-block mx-auto"
                                style="width: 60px; background-color: #7c4dff; height: 2px" />
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
                            <hr class="mb-4 mt-0 d-inline-block mx-auto"
                                style="width: 60px; background-color: #7c4dff; height: 2px" />
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
                            <hr class="mb-4 mt-0 d-inline-block mx-auto"
                                style="width: 60px; background-color: #7c4dff; height: 2px" />
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
                            <hr class="mb-4 mt-0 d-inline-block mx-auto"
                                style="width: 60px; background-color: #7c4dff; height: 2px" />
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


    <!-- SCRIPT -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>