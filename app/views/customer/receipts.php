<?php
include _DIR_ROOT . "/app/views/partials/header.php";
?>

<script>
    document.title = "Hóa đơn";
</script>

<style>
    body {
        background-color: rgb(240, 240, 240);
    }
</style>

<div class="main container-fluid cart-main">
    <div class="row" id="cart-view">
        <div class="col-md-12 mt-4 fs-2 d-flex justify-content-between">
            <p class="bi bi-receipt-cutoff text-muted"> Các đơn hàng</p>
            <a href="<?php echo SITEURL ?>/customer/logout" class="btn fs-4">
                Đăng xuất
                <i class="bi bi-box-arrow-right text-danger"></i>
            </a>
        </div>

        <div class="col-md-12 product-description mt-2 row">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-order-all-tab" data-bs-toggle="tab" data-bs-target="#nav-order-all" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Tất cả</button>
                    <button class="nav-link" id="nav-order-pending-tab" data-bs-toggle="tab" data-bs-target="#nav-order-pending" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Chờ xác nhận</button>
                    <button class="nav-link" id="nav-order-being-transported-tab" data-bs-toggle="tab" data-bs-target="#nav-order-being-transported" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Vận chuyển</button>
                    <button class="nav-link" id="nav-order-canceled-tab" data-bs-toggle="tab" data-bs-target="#nav-order-canceled" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Đã hủy</button>
                    <button class="nav-link" id="nav-order-completed-tab" data-bs-toggle="tab" data-bs-target="#nav-order-completed" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Hoàn thành</button>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active row" id="nav-order-all" role="tabpanel" aria-labelledby="nav-order-all-tab">
                    <?php
                    foreach ($receipts as $receipt) {
                    ?>
                        <!--  -->
                        <div class="col-md-12 bg-light px-3 mb-3 cart-shadow py-3" style="border-radius: 5px;">
                            <div class="col-md-12 d-flex justify-content-between">
                                <p class="col-2">Mã: <strong>#<?php echo $receipt['receiptPID']; ?></strong></p>
                                <p class="col-2">Tình trạng: <strong>
                                        <?php
                                        if ($receipt['statusR'] == 0) {
                                        }
                                        switch ($receipt['statusR']) {
                                            case 0:
                                                echo "Chờ xác nhận";
                                                break;
                                            case 1:
                                                echo "Đã xác nhận - Đang giao";
                                                break;
                                            case 2:
                                                echo "Đã hủy";
                                                break;
                                            case 3:
                                                echo "Hoàn thành";
                                                break;
                                            default:
                                                echo "Chờ xác nhận";
                                                break;
                                        }
                                        ?>
                                    </strong></p>
                            </div>
                            <hr class="my-0">
                            <?php
                            foreach ($receipt['products'] as $product) {
                            ?>
                                <!-- Products -->
                                <div class="col-md-12 mt-2 cart-product-info bg-light d-flex d-flex align-items-center">
                                    <div style="width: 40%;" class="mb-4 d-flex align-items-center">
                                        <img src="<?php echo $product['imageURL']; ?>" alt="" class="product-avatar-list" style="width: 70px;">
                                        <span class="product-name ms-2 pe-3" style="word-wrap: break-word; max-width: 70%;">
                                            <?php echo $product['productName']; ?>
                                        </span>
                                    </div>
                                    <div class="mb-4" style="width: 20%;">
                                        <p class="ms-1 mt-3"><?php echo number_format($product['price'], 0, '.', '.'); ?>đ</p>
                                    </div>
                                    <div style="width: 20%;">
                                        <p>3</p>
                                    </div>
                                    <div style="width: 20%;" class="text-danger mb-4 amount">
                                        <?php echo number_format($product['price'] * $product['quantityBuy'], 0, '.', '.'); ?>
                                        <u>đ</u>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                            <hr class="my-0">
                            <div class="col-md-12 d-flex justify-content-between mt-4">
                                <strong>Tổng tỉền: <span class="text-danger"><?php echo number_format($receipt['total'], 0, '.', '.'); ?>đ</span></strong>
                                <button class="btn btn-danger mt-2" disabled>Hủy</button>
                            </div>
                        </div>

                    <?php
                    }
                    ?>
                    <!--  -->
                </div>
                <!--  -->
                <div class="tab-pane fade" id="nav-order-pending" role="tabpanel" aria-labelledby="nav-order-pending-tab">
                    <?php
                    foreach ($receipts as $receipt) {
                        if ($receipt['statusR'] == 0) {
                    ?>
                            <!--  -->
                            <div class="col-md-12 bg-light px-3 mb-3 cart-shadow py-3" style="border-radius: 5px;">
                                <div class="col-md-12 d-flex justify-content-between">
                                    <p class="col-2">Mã: <strong>#<?php echo $receipt['receiptPID']; ?></strong></p>
                                    <p class="col-2">Tình trạng: <strong>
                                            <?php
                                            if ($receipt['statusR'] == 0) {
                                            }
                                            switch ($receipt['statusR']) {
                                                case 0:
                                                    echo "Chờ xác nhận";
                                                    break;
                                                case 1:
                                                    echo "Đã xác nhận - Đang giao";
                                                    break;
                                                case 2:
                                                    echo "Đã hủy";
                                                    break;
                                                case 3:
                                                    echo "Hoàn thành";
                                                    break;
                                                default:
                                                    echo "Chờ xác nhận";
                                                    break;
                                            }
                                            ?>
                                        </strong></p>
                                </div>
                                <hr class="my-0">
                                <?php
                                foreach ($receipt['products'] as $product) {
                                ?>
                                    <!-- Products -->
                                    <div class="col-md-12 mt-2 cart-product-info bg-light d-flex d-flex align-items-center">
                                        <div style="width: 40%;" class="mb-4 d-flex align-items-center">
                                            <img src="<?php echo $product['imageURL']; ?>" alt="" class="product-avatar-list" style="width: 70px;">
                                            <span class="product-name ms-2 pe-3" style="word-wrap: break-word; max-width: 70%;">
                                                <?php echo $product['productName']; ?>
                                            </span>
                                        </div>
                                        <div class="mb-4" style="width: 20%;">
                                            <p class="ms-1 mt-3"><?php echo number_format($product['price'], 0, '.', '.'); ?>đ</p>
                                        </div>
                                        <div style="width: 20%;">
                                            <p>3</p>
                                        </div>
                                        <div style="width: 20%;" class="text-danger mb-4 amount">
                                            <?php echo number_format($product['price'] * $product['quantityBuy'], 0, '.', '.'); ?>
                                            <u>đ</u>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                                <hr class="my-0">
                                <div class="col-md-12 d-flex justify-content-end">
                                    <button class="btn btn-danger mt-2" disabled>Hủy</button>
                                </div>
                            </div>

                    <?php
                        }
                    }
                    ?>
                </div>
                <!--  -->
                <div class="tab-pane fade" id="nav-order-being-transported" role="tabpanel" aria-labelledby="nav-order-being-transported-tab">
                    <?php
                    foreach ($receipts as $receipt) {
                        if ($receipt['statusR'] == 1) {
                    ?>
                            <!--  -->
                            <div class="col-md-12 bg-light px-3 mb-3 cart-shadow py-3" style="border-radius: 5px;">
                                <div class="col-md-12 d-flex justify-content-between">
                                    <p class="col-2">Mã: <strong>#<?php echo $receipt['receiptPID']; ?></strong></p>
                                    <p class="col-2">Tình trạng: <strong>
                                            <?php
                                            if ($receipt['statusR'] == 0) {
                                            }
                                            switch ($receipt['statusR']) {
                                                case 0:
                                                    echo "Chờ xác nhận";
                                                    break;
                                                case 1:
                                                    echo "Đã xác nhận - Đang giao";
                                                    break;
                                                case 2:
                                                    echo "Đã hủy";
                                                    break;
                                                case 3:
                                                    echo "Hoàn thành";
                                                    break;
                                                default:
                                                    echo "Chờ xác nhận";
                                                    break;
                                            }
                                            ?>
                                        </strong></p>
                                </div>
                                <hr class="my-0">
                                <?php
                                foreach ($receipt['products'] as $product) {
                                ?>
                                    <!-- Products -->
                                    <div class="col-md-12 mt-2 cart-product-info bg-light d-flex d-flex align-items-center">
                                        <div style="width: 40%;" class="mb-4 d-flex align-items-center">
                                            <img src="<?php echo $product['imageURL']; ?>" alt="" class="product-avatar-list" style="width: 70px;">
                                            <span class="product-name ms-2 pe-3" style="word-wrap: break-word; max-width: 70%;">
                                                <?php echo $product['productName']; ?>
                                            </span>
                                        </div>
                                        <div class="mb-4" style="width: 20%;">
                                            <p class="ms-1 mt-3"><?php echo number_format($product['price'], 0, '.', '.'); ?>đ</p>
                                        </div>
                                        <div style="width: 20%;">
                                            <p>3</p>
                                        </div>
                                        <div style="width: 20%;" class="text-danger mb-4 amount">
                                            <?php echo number_format($product['price'] * $product['quantityBuy'], 0, '.', '.'); ?>
                                            <u>đ</u>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                                <hr class="my-0">
                                <div class="col-md-12 d-flex justify-content-end">
                                    <button class="btn btn-danger mt-2" disabled>Hủy</button>
                                </div>
                            </div>

                    <?php
                        }
                    }
                    ?>
                </div>
                <!--  -->
                <div class="tab-pane fade" id="nav-order-canceled" role="tabpanel" aria-labelledby="nav-order-canceled-tab">
                    <?php
                    foreach ($receipts as $receipt) {
                        if ($receipt['statusR'] == 2) {
                    ?>
                            <!--  -->
                            <div class="col-md-12 bg-light px-3 mb-3 cart-shadow py-3" style="border-radius: 5px;">
                                <div class="col-md-12 d-flex justify-content-between">
                                    <p class="col-2">Mã: <strong>#<?php echo $receipt['receiptPID']; ?></strong></p>
                                    <p class="col-2">Tình trạng: <strong>
                                            <?php
                                            if ($receipt['statusR'] == 0) {
                                            }
                                            switch ($receipt['statusR']) {
                                                case 0:
                                                    echo "Chờ xác nhận";
                                                    break;
                                                case 1:
                                                    echo "Đã xác nhận - Đang giao";
                                                    break;
                                                case 2:
                                                    echo "Đã hủy";
                                                    break;
                                                case 3:
                                                    echo "Hoàn thành";
                                                    break;
                                                default:
                                                    echo "Chờ xác nhận";
                                                    break;
                                            }
                                            ?>
                                        </strong></p>
                                </div>
                                <hr class="my-0">
                                <?php
                                foreach ($receipt['products'] as $product) {
                                ?>
                                    <!-- Products -->
                                    <div class="col-md-12 mt-2 cart-product-info bg-light d-flex d-flex align-items-center">
                                        <div style="width: 40%;" class="mb-4 d-flex align-items-center">
                                            <img src="<?php echo $product['imageURL']; ?>" alt="" class="product-avatar-list" style="width: 70px;">
                                            <span class="product-name ms-2 pe-3" style="word-wrap: break-word; max-width: 70%;">
                                                <?php echo $product['productName']; ?>
                                            </span>
                                        </div>
                                        <div class="mb-4" style="width: 20%;">
                                            <p class="ms-1 mt-3"><?php echo number_format($product['price'], 0, '.', '.'); ?>đ</p>
                                        </div>
                                        <div style="width: 20%;">
                                            <p>3</p>
                                        </div>
                                        <div style="width: 20%;" class="text-danger mb-4 amount">
                                            <?php echo number_format($product['price'] * $product['quantityBuy'], 0, '.', '.'); ?>
                                            <u>đ</u>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                                <hr class="my-0">
                                <div class="col-md-12 d-flex justify-content-end">
                                    <button class="btn btn-danger mt-2" disabled>Hủy</button>
                                </div>
                            </div>

                    <?php
                        }
                    }
                    ?>
                </div>
                <!--  -->
                <div class="tab-pane fade" id="nav-order-completed" role="tabpanel" aria-labelledby="nav-order-completed-tab">
                    <?php
                    foreach ($receipts as $receipt) {
                        if ($receipt['statusR'] == 3) {
                    ?>
                            <!--  -->
                            <div class="col-md-12 bg-light px-3 mb-3 cart-shadow py-3" style="border-radius: 5px;">
                                <div class="col-md-12 d-flex justify-content-between">
                                    <p class="col-2">Mã: <strong>#<?php echo $receipt['receiptPID']; ?></strong></p>
                                    <p class="col-2">Tình trạng: <strong>
                                            <?php
                                            if ($receipt['statusR'] == 0) {
                                            }
                                            switch ($receipt['statusR']) {
                                                case 0:
                                                    echo "Chờ xác nhận";
                                                    break;
                                                case 1:
                                                    echo "Đã xác nhận - Đang giao";
                                                    break;
                                                case 2:
                                                    echo "Đã hủy";
                                                    break;
                                                case 3:
                                                    echo "Hoàn thành";
                                                    break;
                                                default:
                                                    echo "Chờ xác nhận";
                                                    break;
                                            }
                                            ?>
                                        </strong></p>
                                </div>
                                <hr class="my-0">
                                <?php
                                foreach ($receipt['products'] as $product) {
                                ?>
                                    <!-- Products -->
                                    <div class="col-md-12 mt-2 cart-product-info bg-light d-flex d-flex align-items-center">
                                        <div style="width: 40%;" class="mb-4 d-flex align-items-center">
                                            <img src="<?php echo $product['imageURL']; ?>" alt="" class="product-avatar-list" style="width: 70px;">
                                            <span class="product-name ms-2 pe-3" style="word-wrap: break-word; max-width: 70%;">
                                                <?php echo $product['productName']; ?>
                                            </span>
                                        </div>
                                        <div class="mb-4" style="width: 20%;">
                                            <p class="ms-1 mt-3"><?php echo number_format($product['price'], 0, '.', '.'); ?>đ</p>
                                        </div>
                                        <div style="width: 20%;">
                                            <p>3</p>
                                        </div>
                                        <div style="width: 20%;" class="text-danger mb-4 amount">
                                            <?php echo number_format($product['price'] * $product['quantityBuy'], 0, '.', '.'); ?>
                                            <u>đ</u>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                                <hr class="my-0">
                                <div class="col-md-12 d-flex justify-content-end">
                                    <button class="btn btn-danger mt-2" disabled>Hủy</button>
                                </div>
                            </div>

                    <?php
                        }
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