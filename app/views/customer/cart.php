<?php
include _DIR_ROOT . "/app/views/partials/header.php";
?>

<style>
    body {
        background-color: rgb(240, 240, 240);
    }
</style>

<!-- Modal confirm -->
<div class="modal fade modal-confirm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="width: 380px;">
        <div class="modal-content">
            <div class="modal-body container-fluid">
                <div class="row">
                    <div class="col-md-12 d-flex">
                        <i class="bi bi-exclamation-triangle me-2 text-warning fs-4"></i>
                        <h5 class="modal-title me-auto mt-1" id="modal-confirm-title">Xác nhận?</h5>
                    </div>
                    <div class="col-md-12 d-flex justify-content-center px-5 mt-2">
                        <p id="modal-confirm-content"></p>
                    </div>
                    <div class="col-md-12 d-flex justify-content-end">
                        <button type="button" id="btn-confirm" class="btn me-2" style="border: solid 2px #1687d8; color: #1687d8;font-weight:500">Xác nhận</button>
                        <button type="button" class="btn text-light" style="background-color: #1687d8;font-weight:500" data-bs-dismiss="modal">Hủy</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--  -->

<div class="main container-fluid cart-main">
    <div class="row" id="cart-view">
        <div class="col-md-12 mt-4 fs-1">
            <p class="bi bi-cart3 text-muted">Giỏ hàng</p>
        </div>

        <!-- SHOW PRODUCTS -->

        <div class="col-md-12 col-lg-9 mb-5">
            <div class="product-cart-attr mb-4 col-md-12 bg-light d-flex align-items-center px-3 py-2 cart-shadow">
                <div style="width: 40%;"><input id="btn-check-all-cart" class="me-1 form-check-input" type="checkbox" style="cursor: pointer;">Tất cả (0 sản phẩm)</div>
                <div style="width: 20%;">Giá</div>
                <div style="width: 20%;">Số lượng</div>
                <div style="width: 20%;">Thành tiền</div>
                <i class="bi bi-trash text-muted fs-4 btn-clear-cart" type="button"></i>
            </div>

            <?php
            foreach ($products as $product) {
            ?>
                <!-- Product -->
                <div class="cart-shadow cart-product-info bg-light mb-0 mt-3 col-md-12 d-flex d-flex align-items-center px-3 pb-2 pt-4">
                    <div style="width: 40%;" class="mb-4 d-flex align-items-center">
                        <input class="btn-check-product me-1 form-check-input" type="checkbox" style="cursor: pointer;" data-prodid="<?php echo $product['productID']; ?>" value=" <?php echo $product['price'] * $product['quantity']; ?>">
                        <img src="<?php echo $product['image1']; ?>" alt="" class="product-avatar-list" style="width: 70px;">
                        <span class="product-name ms-2 pe-3" style="word-wrap: break-word; max-width: 70%;"><?php echo $product['productName']; ?></span>
                    </div>
                    <div class="mb-4" style="width: 20%;">
                        <p class="ms-1 mt-3"><?php echo number_format($product['price'], 0, '.', '.'); ?>đ</p>
                    </div>
                    <div style="width: 20%;">
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link bi bi-dash-lg btn-decrease-cart" type="button" data-prodid="<?php echo $product['productID']; ?>"></a>
                            </li>
                            <li class="page-item">
                                <input type="text" class="page-link px-2 text-dark input-quantity-cart" autocomplete="off" data-prodid="<?php echo $product['productID']; ?>" data-prod_price="<?php echo $product['price']; ?>" data-prod_stock="<?php echo $product['stock']; ?>" value="<?php echo $product['quantity']; ?>" style="width: 40px;">
                            </li>
                            <li class="page-item">
                                <a class="page-link bi-plus-lg btn-increase-cart" type="button" data-prodid="<?php echo $product['productID']; ?>"></a>
                            </li>
                        </ul>
                    </div>
                    <div style="width: 20%;" class="text-danger mb-4 amount" data-prodid="<?php echo $product['productID']; ?>" data-amount="
                    <?php echo $product['price'] * $product['quantity']; ?>">
                        <?php echo number_format($product['price'] * $product['quantity'], 0, '.', '.'); ?>
                        <u>đ</u>
                    </div>
                    <div class="mb-4"><i type="button" class="bi bi-trash text-muted fs-5 btn-remove-product-cart" data-prodid="<?php echo $product['productID']; ?>"></i></div>
                </div>
                <!-- Product -->
            <?php
            }
            ?>


        </div>

        <!-- Form -->
        


        <!-- ACTIONS -->
        <div class="col-md-12 col-lg-3 cart-actions">
            <div class="col-md-12 bg-light px-3 cart-shadow">
                <div class="col-md-12 d-flex justify-content-between pt-2">
                    <p class="text-muted">Giao tới</p>
                    <a href="#" class="text-decoration-none">Thay đổi</a>
                </div>
                <div class="col-md-12">
                    <strong></strong>
                    <p class="text-muted mt-1 pb-4"></p>
                </div>
            </div>

            <div class="col-md-12 bg-light px-3 mb-3 cart-shadow">
                <div class="col-md-12 d-flex justify-content-between pt-2">
                    <p class="">Khuyến mãi</p>
                    <p class="text-muted">Có thể chọn(0) <i type="button" class="bi bi-info-circle"></i></p>
                </div>
                <div class="col-md-12 d-flex justify-content-center pb-4">
                    <h3 class="text-muted">Không áp dụng</h3>
                </div>
            </div>

            <div class="col-md-12 bg-light px-3 mb-3 cart-shadow">
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
            
            <form action="<?php echo SITEURL; ?>customer/order" method="post">
                <button id="btn-order" type="submit" class="btn btn-danger col-md-12 py-2 mb-3">
                    <h4 class="mt-1">Mua hàng</h4>
                </button>
            </form>

            
        </div>

    </div>
</div>


<?php
include _DIR_ROOT . "/app/views/partials/footer.php";
?>