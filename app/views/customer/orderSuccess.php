<?php
include _DIR_ROOT . "/app/views/partials/header.php";
?>

<style>
    .main{
        background-color: #F4F6F7;
    }
</style>

<div class="main container-fluid" style="min-height: 75vh;">
    <div class="row">
        <div class="col-md-12 d-flex justify-content-center container mt-5">
            <div class="col-md-12" style="width: max-content;">
                <i class="bi bi-cart-check-fill text-info" style="font-size: 70px;"></i>
            </div>
        </div>
        <div class="col-md-12 d-flex justify-content-center container">
            <div class="col-md-12" style="width: max-content;">
                <h3 class="mt-4 col-md-12" style="width: auto;">Đã đặt hàng thành công</h3>
                <h4 class="mt-4 col-md-12" style="width: auto;">Mã đơn hàng: #<?php echo $receiptID; ?></h4>
            </div>
        </div>
    </div>
</div>

<?php
include _DIR_ROOT . "/app/views/partials/footer.php";
?>