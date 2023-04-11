<?php
include _DIR_ROOT."/app/views/partials/header.php";
?>


<!-- Main -->
<div class="container-fluid main p-0">
    <div class="row">
        <!-- Banner 1 -->
        <div class="col-md-12 mb-5 banner p-0">
            <img src="<?php echo SITEURL ?>app/assets/images/banner-bg.jpg" alt="">
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
                <div class="col-md-12 row d-flex justify-content-start">

                    <?php
                    foreach ($productsBestSold as $product) {
                    ?>
                        <!-- Items -->
                        <div class="pb-3 items-card col-sm-5 col-md-3" style="width: 17rem;">


                            <div class="col-md-12 product-image">
                                <a href="<?php echo SITEURL ?>product/detail/<?php echo $product['productID']; ?>" class="">
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
                                <button class="btn btn-info text-light btn-add-to-cart" style="background-color:  rgb(58, 160, 180);" data-customer_id="<?php echo $_SESSION['customerID'] ?>" data-product_id="<?php echo $product['productID']; ?>">Thêm vào giỏ</button>
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
            <img src="<?php echo SITEURL ?>app/assets/images/office-banner.jpg" alt="">
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
                <div class="col-md-12 row d-flex justify-content-start">

                    <?php
                    foreach ($productsCatThietBi as $product) {
                    ?>
                        <!-- Items -->
                        <div class="pb-3 items-card col-sm-5 col-md-3" style="width: 17rem;">
                            <div class="col-md-12 product-image">
                                <a href="<?php echo SITEURL ?>product/detail/<?php echo $product['productID']; ?>">
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
                                <button class="btn btn-info text-light btn-add-to-cart" style="background-color:  rgb(58, 160, 180);" data-customer_id="<?php echo $_SESSION['customerID'] ?>" data-product_id="<?php echo $product['productID']; ?>">Thêm vào giỏ</button>
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


<?php
include _DIR_ROOT."/app/views/partials/footer.php";
?>