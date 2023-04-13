<?php
include _DIR_ROOT . "/app/views/partials/header.php";
?>

<style>
    body {
        background-color: rgb(240, 240, 240);
    }
</style>

<div class="container-fluid main p-0" style="max-width: 1200px;">
    <div class="row">
        <div class="col-md-12 d-flex align-items-center bg-light order-shadow">
            <img src="<?php echo SITEURL; ?>app/assets/images/logo.png" alt="image" style="width: 150px;">
            <span class="fs-4 pt-1 ps-3" style="color:orangered;border-left: 1px solid;">Đặt hàng</span>
        </div>

        <div class="col-md-12 row d-flex bg-light order-shadow mt-2 px-5 py-3 mx-0">
            <div class="col-md-12 text-danger fs-5">
                <i class="bi bi-geo-alt-fill"></i>
                Địa chỉ nhận hàng
            </div>
            <div class="col-md-12">
                <strong class="col">
                    Dương Công -
                </strong>
                <strong class="col">
                    0373785045
                </strong>
                <p class="col">
                    Số 68 ngõ 15, Tạ Quang Bửu, Hà Nội
                </p>
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

            <!-- Product -->
            <div class="product-cart-attr mb-0 col-md-12 bg-light d-flex align-items-center px-3 py-0">
                <div style="width: 50%;" class="mb-4 d-flex align-items-center">
                    <img src="<?php echo SITEURL ?>app/assets/images/products/bam_lo.jpg" alt="" class="product-avatar-list" style="width: 70px;">
                    <span class="product-name ms-2 pe-3" style="word-wrap: break-word; max-width: 70%;">Bấm kim 50LA</span>
                </div>
                <div class="mb-4" style="width: 20%;">
                    <p class="ms-1 mt-3">15000đ</p>
                </div>
                <div style="width: 20%;" class="mb-4 ps-3">
                    4
                </div>
                <div style="width: 10%;" class="text-danger mb-4 amount ps-2" data-prodid="" data-amount="">
                    <u>60000đ</u>
                </div>
            </div>


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
                    <input class="form-check-input" type="radio" name="paymentMethodRadio" id="">
                    <img src="<?php echo SITEURL ?>app/assets/images/payment_method/cod.png" alt="COD" style="width: 45px;" class="me-3">
                    <label class="form-check-label" for="">
                        Giao hàng thu tiền mặt (COD)
                    </label>
                </div>
                <!--  -->
                <div class="form-check mt-5">
                    <input class="form-check-input" type="radio" name="paymentMethodRadio" id="">
                    <img src="<?php echo SITEURL ?>app/assets/images/payment_method/bank_logo.png" alt="bank" style="width: 45px;" class="me-3">
                    <label class="form-check-label" for="">
                        Thanh toán qua ngân hàng nội địa
                    </label>
                </div>
                <!--  -->
                <div class="form-check mt-5">
                    <input class="form-check-input" type="radio" name="paymentMethodRadio" id="">
                    <img src="<?php echo SITEURL ?>app/assets/images/payment_method/Visa_logo.png" alt="visa" style="width: 45px;" class="me-3">
                    <label class="form-check-label" for="">
                        Visa
                    </label>
                </div>
                <!--  -->
                <div class="form-check mt-5">
                    <input class="form-check-input" type="radio" name="paymentMethodRadio" id="">
                    <img src="<?php echo SITEURL ?>app/assets/images/payment_method/mastercard-logo.png" alt="mastercard" style="width: 45px;" class="me-3">
                    <label class="form-check-label" for="">
                        MasterCard
                    </label>
                </div>
                <!--  -->
                <div class="form-check mt-5 mb-5">
                    <input class="form-check-input" type="radio" name="paymentMethodRadio" id="">
                    <img src="<?php echo SITEURL ?>app/assets/images/payment_method/ZaloPay_Logo.png" alt="zalopay" style="width: 45px;" class="me-3">
                    <label class="form-check-label" for="">
                        ZaloPay
                    </label>
                </div>

            </div>
        </div>

        <!-- Order confirm -->
        <div class="col-md-12 row d-flex justify-content-between bg-light order-shadow mt-2 px-5 py-3 mx-0">
            <div class="col-8 text-muted">
                <p>Tổng tiền hàng: 50.000đ</p>
                <p>Phí vận chuyển: 0đ <del>30.000đ</del> (Miễn phí)</p>
                <p>Tổng thanh toán: <strong class="text-danger fs-4">50.000đ</strong></p>
            </div>
            <div class="col-2 mt-4">
                <form action="<?php echo SITEURL; ?>customer/order" method="post">
                    <button id="btn-order" type="submit" disabled class="btn btn-danger col-md-12 mb-3" style="width: 200;">
                        <h6 class="mt-2">Đặt hàng</h6>
                    </button>
                </form>
            </div>
        </div>


    </div>
</div>

<?php
include _DIR_ROOT . "/app/views/partials/footer.php";
?>