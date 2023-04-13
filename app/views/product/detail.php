<?php
include _DIR_ROOT . "/app/views/partials/header.php";
?>

<script>
    document.title = "<?php echo $productDetails['productName']; ?>";
</script>

<!-- Main -->
<div class="container-fluid main p-0 mt-5">
    <div class="row" style="max-width: 1200px;margin: auto;">
        <div class="col-sm-12 col-md-6 product-image row">
            <div class="col-md-12">
                <img src="<?php echo $productDetails['image1']; ?>" alt="Product" class="w-100">
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
                        <img style="width: 100px;" src="<?php echo SITEURL ?>app/assets/images/express/logo-ghn.jpg" alt="">
                    </div>
                    <div class="col">
                        <img style="width: 100px;" src="<?php echo SITEURL ?>app/assets/images/express/logo-ghtk.jpg" alt="">
                    </div>
                    <div class="col">
                        <img style="width: 100px;" src="<?php echo SITEURL ?>app/assets/images/express/logo-ninja-van.jpg" alt="">
                    </div>
                </div>
                <div class="col-md-12 row">
                    <div class="col">
                        <img style="width: 100px;" src="<?php echo SITEURL ?>app/assets/images/express/logo-shipchung.jpg" alt="">
                    </div>
                    <div class="col">
                        <img style="width: 100px;" src="<?php echo SITEURL ?>app/assets/images/express/logo-viettle-post.jpg" alt="">
                    </div>
                    <div class="col">
                        <img style="width: 100px;" src="<?php echo SITEURL ?>app/assets/images/express/logo-vn-post.jpg" alt="">
                    </div>
                </div>
            </div>

            <!--  -->
            <div class="item-num d-flex mt-5 mb-2">
                <ul class="pagination justify-content-end">
                    <li class="page-item page-item-btn-decrease">
                        <a class="page-link bi bi-dash-lg" id="btn-decrease-quantity-detail" type="button"></a>
                    </li>
                    <li class="page-item">
                        <input type="text" id="input-quantity-detail" class="page-link px-2 text-dark" autocomplete="off" value="1" style="width: 50px;" data-prod_stock="<?php echo $productDetails['stock']; ?>">
                    </li>
                    <li class="page-item">
                        <a class="page-link bi-plus-lg" id="btn-increase-quantity-detail" type="button"></a>
                    </li>
                </ul>
                <?php
                if ($productDetails['stock'] > 0) {
                ?>
                    <button class="btn btn-info text-light btn-add-to-cart-detail" style="background-color:  rgb(58, 160, 180);" data-customer_id="<?php echo $_SESSION['customerID'] ?>" data-product_id="<?php echo $productDetails['productID']; ?>">
                        Thêm vào giỏ
                    </button>
                <?php } else {
                ?>
                    <button class="btn btn-info text-light btn-out-of-stock bg-secondary" style="border: grey;" disabled>Hết hàng</button>
                <?php
                }
                ?>
            </div>

            <!--  -->
        </div>

        <div class="col-md-12 product-description mt-2 row">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-description-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">MÔ TẢ</button>
                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">ĐÁNH
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
                    <h3>Có thể bạn cũng thích</h3>
                </div>
                <div class="col-md-12 row d-flex justify-content-evenly">


                    <?php
                    foreach ($alsoLikeProducts as $product) {
                    ?>
                        <!-- Items -->
                        <div class="pb-3 items-card col-sm-5 col-md-3" style="width: 17rem;">
                            <div class="col-md-12 product-image">
                                <a href="<?php echo SITEURL . 'product/detail/' . $product['productID']; ?>">
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
                                <?php
                                if ($product['stock'] > 0) {
                                ?>
                                    <button class="btn btn-info text-light btn-add-to-cart" style="background-color:  rgb(58, 160, 180);" data-customer_id="<?php echo $_SESSION['customerID'] ?>" data-product_id="<?php echo $product['productID']; ?>">Thêm vào giỏ</button>
                                <?php } else {
                                ?>
                                    <button class="btn btn-info text-light btn-out-of-stock bg-secondary" style="border: grey;" disabled>Hết hàng</button>
                                <?php
                                }
                                ?>
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
include _DIR_ROOT . "/app/views/partials/footer.php";
?>