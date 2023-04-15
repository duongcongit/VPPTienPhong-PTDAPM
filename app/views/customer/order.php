<?php
include _DIR_ROOT . "/app/views/partials/header.php";
?>

<style>
    body {
        background-color: rgb(240, 240, 240);
    }
</style>

<form action="<?php echo SITEURL ?>customer/orderProcess" method="post" class="container-fluid main p-0" style="max-width: 1200px;">

    <div class="row">
        <div class="col-md-12 d-flex align-items-center bg-light order-shadow">
            <img src="<?php echo SITEURL; ?>app/assets/images/logo.png" alt="image" style="width: 150px;">
            <span class="fs-4 pt-1 ps-3" style="color:orangered;border-left: 1px solid;">Đặt hàng</span>
        </div>

        <div class="col-md-12 row d-flex bg-light order-shadow mt-2 px-5 py-3 mx-0">
            <div class="col-md-12 text-danger fs-5 mb-2">
                <i class="bi bi-geo-alt-fill"></i>
                Địa chỉ nhận hàng
            </div>
            <div class="col-md-12" style="width: fit-content;">
                <strong class="col">
                    <?php echo $orderDetail['deliveryInfo']['consigneeName']; ?> -
                </strong>
                <strong class="col">
                    <?php echo $orderDetail['deliveryInfo']['phoneNumber']; ?>
                </strong>
                <p class="col mt-2">
                    <?php echo $orderDetail['deliveryInfo']['deliveryAddress']; ?>
                </p>
            </div>
            <div class="col-md-12">
                <div class="btn btn-light" style="color:orangered">Chỉnh sửa</div>
            </div>
        </div>

        <!--  -->
        <div class="col-md-12 row d-flex bg-light order-shadow mt-2 px-5 py-3 mx-0">


            <div class="product-cart-attr mb-4 col-md-12 bg-light d-flex align-items-center px-3 py-2">
                <div style="width: 50%;">
                    <p class="fs-5">Sản phẩm</p>
                </div>
                <div style="width: 20%;">Đơn giá</div>
                <div style="width: 20%;">Số lượng</div>
                <div style="width: 10%;">Thành tiền</div>
            </div>

            <?php
            foreach ($orderDetail['products'] as $product) {
            ?>
                <!-- Product -->
                <div class="product-cart-attr mb-0 col-md-12 bg-light d-flex align-items-center px-3 py-0">
                    <div style="width: 50%;" class="mb-4 d-flex align-items-center">
                        <img src="<?php echo $product['image']; ?>" alt="" class="product-avatar-list" style="width: 70px;">
                        <span class="product-name ms-2 pe-3" style="word-wrap: break-word; max-width: 70%;"><?php echo $product['productName']; ?></span>
                    </div>
                    <div class="mb-4" style="width: 20%;">
                        <p class="ms-1 mt-3"><?php echo number_format($product['price'], 0, '.', '.'); ?>đ</p>
                    </div>
                    <div style="width: 20%;" class="mb-4 ps-3">
                        <?php echo $product['quantity']; ?>
                    </div>
                    <div style="width: 10%;" class="text-danger mb-4 amount ps-2" data-prodid="" data-amount="">
                        <u><?php echo number_format($product['amount'], 0, '.', '.'); ?>đ</u>
                    </div>
                </div>

            <?php
            }
            ?>


        </div>

        <!-- Payment method select -->
        <div class="col-md-12 row d-flex bg-light order-shadow mt-2 px-5 py-3 mx-0">
            <div class="col-md-12 mb-3 mt-3">
                <h5>Phương thức thanh toán</h5>

            </div>
            <hr>
            <div class="col-md-12">
                <!--  -->
                <div class="form-check mt-3">
                    <input checked class="form-check-input mt-3" type="radio" name="paymentMethodRadio" value="1">
                    <img src="<?php echo SITEURL ?>app/assets/images/payment_method/cod.png" alt="COD" style="width: 45px;" class="me-3">
                    <label class="form-check-label" for="" style="font-weight: bold;">
                        Giao hàng thu tiền mặt (COD)
                    </label>
                </div>
                <!--  -->
                <div class="form-check mt-5">
                    <input class="form-check-input mt-3" disabled type="radio" name="paymentMethodRadio" value="2">
                    <img src="<?php echo SITEURL ?>app/assets/images/payment_method/bank_logo.png" alt="bank" style="width: 45px;" class="me-3">
                    <label class="form-check-label" for="">
                        <strong>toán qua ngân hàng nội địa</strong> - (Không khả dụng)
                    </label>
                </div>
                <!--  -->
                <div class="form-check mt-5">
                    <input class="form-check-input mt-1" disabled type="radio" name="paymentMethodRadio" value="3">
                    <img src="<?php echo SITEURL ?>app/assets/images/payment_method/Visa_logo.png" alt="visa" style="width: 45px;" class="me-3">
                    <label class="form-check-label" for="">
                        <strong>Visa</strong> - (Không khả dụng)
                    </label>
                </div>
                <!--  -->
                <div class="form-check mt-5">
                    <input class="form-check-input mt-2" disabled type="radio" name="paymentMethodRadio" value="4">
                    <img src="<?php echo SITEURL ?>app/assets/images/payment_method/mastercard-logo.png" alt="mastercard" style="width: 45px;" class="me-3">
                    <label class="form-check-label" for="">
                        <strong>MasterCard</strong> - (Không khả dụng)
                    </label>
                </div>
                <!--  -->
                <div class="form-check mt-5 mb-5">
                    <input class="form-check-input" disabled type="radio" name="paymentMethodRadio" value="5">
                    <img src="<?php echo SITEURL ?>app/assets/images/payment_method/ZaloPay_Logo.png" alt="zalopay" style="width: 45px;" class="me-3">
                    <label class="form-check-label" for="">
                        <strong>ZaloPay</strong> - (Không khả dụng)
                    </label>
                </div>

            </div>
        </div>

        <!-- Order confirm -->
        <div class="col-md-12 row d-flex justify-content-between bg-light order-shadow mt-2 px-5 py-3 mx-0">
            <div class="col-8 text-muted">
                <p>Tổng tiền hàng: <?php echo number_format($orderDetail['total'], 0, '.', '.'); ?>đ</p>
                <p>Phí vận chuyển: 0đ <del>30.000đ</del> (Miễn phí)</p>
                <p>Tổng thanh toán: <strong class="text-danger fs-4"><?php echo number_format($orderDetail['total'], 0, '.', '.'); ?>đ</strong></p>
            </div>

            <!--  -->


            <div class="col-2 mt-4">
                <button id="btn-order" type="submit" class="btn btn-danger col-md-12 mb-3" style="width: 200;">
                    <input type="hidden" name="order">
                    <h6 class="mt-2">Đặt hàng</h6>
                </button>
            </div>
        </div>


    </div>

</form>

<?php
include _DIR_ROOT . "/app/views/partials/footer.php";
?>