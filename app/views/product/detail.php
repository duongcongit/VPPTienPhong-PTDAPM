<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết</title>
    <link rel="icon" type="image/x-icon" href="../../assets/images/favicon_io/favicon-32x32.png">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../app/assets/css/style.css">
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
                    <a class="navbar-brand" href="./index.php"><img src="../../app/assets/images/logo.png" alt="" style="width: 150px;"></a>
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


    <!-- Main -->
    <div class="container-fluid main p-0 mt-5">
        <div class="row" style="max-width: 1200px;margin: auto;">
            <div class="col-sm-12 col-md-6 product-image row">
                <div class="col-md-12">
                    <img src="<?php echo $productDetails['image1']; ?>" alt="Product" class="w-100">
                </div>
                <div class="col-sm-12 col-md-12">

                </div>
            </div>

            <!--  -->
            <div class="col-md-6 product-detail mt-2 row">
                <h2 class="product-name"><?php echo $productDetails['productName']; ?></h2>
                <hr class="p-0 m-0 me-auto d-none d-md-flex" style="width: 50%;">
                <h3 class="product-price mt-3" style="font-weight: bold;"><?php echo $productDetails['price']; ?>đ</h3>
                <div class="col-md-12 mt-3">
                    <strong class="mt-5 mb-5">Đã bán: </strong><span><?php echo $productDetails['sold']; ?></span>
                </div>
                <div class="col-md-12 mt-3">
                    <strong class="mt-5 mb-5">Kho: </strong><span><?php echo $productDetails['stock']; ?></span>
                </div>
                <div class="col-md-12 mt-3">
                    <strong>NSX: </strong><span><?php echo $productDetails['supplierName']; ?></span>
                </div>
                <!--  -->
                <div class="col-md-12 mt-3">
                    <strong>Giao hàng thu tiền (COD):</strong>
                    <div class="col-md-12 row">
                        <div class="col">
                            <img style="width: 100px;" src="../../app/assets/images/express/logo-ghn.jpg" alt="">
                        </div>
                        <div class="col">
                            <img style="width: 100px;" src="../../app/assets/images/express/logo-ghtk.jpg" alt="">
                        </div>
                        <div class="col">
                            <img style="width: 100px;" src="../../app/assets/images/express/logo-ninja-van.jpg" alt="">
                        </div>
                    </div>
                    <div class="col-md-12 row">
                        <div class="col">
                            <img style="width: 100px;" src="../../app/assets/images/express/logo-shipchung.jpg" alt="">
                        </div>
                        <div class="col">
                            <img style="width: 100px;" src="../../app/assets/images/express/logo-viettle-post.jpg" alt="">
                        </div>
                        <div class="col">
                            <img style="width: 100px;" src="../../app/assets/images/express/logo-vn-post.jpg" alt="">
                        </div>
                    </div>
                </div>

                <!--  -->
                <div class="item-num d-flex mt-5 mb-2">
                    <ul class="pagination justify-content-end">
                        <li class="page-item page-item-btn-decrease">
                            <a class="page-link bi bi-dash-lg" id="btn-decrease" type="button"></a>
                        </li>
                        <li class="page-item">
                            <input type="text" id="input-quantity-detail" class="page-link px-2 text-dark"
                                autocomplete="off" value="1" style="width: 50px;" data-prod_stock="">
                        </li>
                        <li class="page-item">
                            <a class="page-link bi-plus-lg" id="btn-increase" type="button"></a>
                        </li>
                    </ul>
                    <button class="btn btn-info text-light btn-add-to-cart"
                        style="background-color:  rgb(58, 160, 180);">Thêm vào
                        giỏ</button>
                </div>
                <!--  -->

            </div>

            <div class="col-md-12 product-description mt-2 row">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-description-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                            aria-selected="true">MÔ TẢ</button>
                        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                            type="button" role="tab" aria-controls="nav-profile" aria-selected="false">ĐÁNH
                            GIÁ(0)</button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <strong class="product-name fs-5"><?php echo $productDetails['productName']; ?></strong>
                        <p>
                        <?php echo $productDetails['detail']; ?>
                        </p>
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <h4>Chưa có đánh giá</h4>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="content ps-3 mt-5">
                <div class="col-md-12">
                    <div class="col-md-12 d-flex justify-content-between mb-3">
                        <h3>Sản phẩm tương tự</h3>
                    </div>
                    <div class="col-md-12 row d-flex justify-content-evenly">
                        <!-- Items -->
                        <div class="pb-3 items-card col-sm-5 col-md-3" style="width: 17rem;">
                            <img src="./images/products/print.png" class="card-img-top" alt="...">
                            <hr class="p-0 m-0 mb-4 m-auto d-none d-md-flex" style="width: 50%;">
                            <div class="d-flex justify-content-center">
                                <h6 class="card-title">Máy in laser</h6>
                            </div>
                            <div class="d-flex justify-content-center">
                                <strong>90.000đ</strong>
                            </div>
                            <div class="d-flex justify-content-center pt-3">
                                <!-- rgb(13,202,240)
                                            rgb(0,179,160) -->
                                <button class="btn btn-info text-light"
                                    style="background-color:  rgb(58, 160, 180);">Thêm vào giỏ</button>
                            </div>
                        </div>

                        <!-- Items -->
                        <div class="pb-3 items-card col-sm-5 col-md-3" style="width: 17rem;">
                            <img src="./images/products/print.png" class="card-img-top" alt="...">
                            <hr class="p-0 m-0 mb-4 m-auto d-none d-md-flex" style="width: 50%;">
                            <div class="d-flex justify-content-center">
                                <h6 class="card-title">Máy in laser</h6>
                            </div>
                            <div class="d-flex justify-content-center">
                                <strong>90.000đ</strong>
                            </div>
                            <div class="d-flex justify-content-center pt-3">
                                <!-- rgb(13,202,240)
                                            rgb(0,179,160) -->
                                <button class="btn btn-info text-light"
                                    style="background-color:  rgb(58, 160, 180);">Thêm vào giỏ</button>
                            </div>
                        </div>

                        <!-- Items -->
                        <div class="pb-3 items-card col-sm-5 col-md-3" style="width: 17rem;">
                            <img src="./images/products/print.png" class="card-img-top" alt="...">
                            <hr class="p-0 m-0 mb-4 m-auto d-none d-md-flex" style="width: 50%;">
                            <div class="d-flex justify-content-center">
                                <h6 class="card-title">Máy in laser</h6>
                            </div>
                            <div class="d-flex justify-content-center">
                                <strong>90.000đ</strong>
                            </div>
                            <div class="d-flex justify-content-center pt-3">
                                <!-- rgb(13,202,240)
                                            rgb(0,179,160) -->
                                <button class="btn btn-info text-light"
                                    style="background-color:  rgb(58, 160, 180);">Thêm vào giỏ</button>
                            </div>
                        </div>

                        <!-- Items -->
                        <div class="pb-3 items-card col-sm-5 col-md-3" style="width: 17rem;">
                            <img src="./images/products/print.png" class="card-img-top" alt="...">
                            <hr class="p-0 m-0 mb-4 m-auto d-none d-md-flex" style="width: 50%;">
                            <div class="d-flex justify-content-center">
                                <h6 class="card-title">Máy in laser</h6>
                            </div>
                            <div class="d-flex justify-content-center">
                                <strong>90.000đ</strong>
                            </div>
                            <div class="d-flex justify-content-center pt-3">
                                <!-- rgb(13,202,240)
                                            rgb(0,179,160) -->
                                <button class="btn btn-info text-light"
                                    style="background-color:  rgb(58, 160, 180);">Thêm vào giỏ</button>
                            </div>
                        </div>



                    </div>
                </div>

            </div>

        </div>
    </div>


    <!-- <hr class="p-0 m-0 m-auto d-none d-md-flex" style="width: 95%;"> -->
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




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>