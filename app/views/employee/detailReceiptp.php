<?php
    if (!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    if (!isset($_SESSION['empID'])) {
        header("Location:" .SITEURL."employee/login");
    }
    include _DIR_ROOT.'/app/views/employee/partials/header.php';  
?> 
   
<div class="col main-right container-fluid row ">
    <div class="col-md-12 mt-4 mb-3 nav-page">
        <h5 class="text-muted">
            <a href="<?php echo SITEURL; ?>employee/">Trang nhân viên</a> / </span>
            <a href="<?php echo SITEURL; ?>employee/">Quản lý đơn hàng</a> / </span>
            <a href="<?php echo SITEURL; ?>employee/detail/<?php echo $detail['receiptPID'] ?>">Chi tiết đơn hàng</a>
        </h5>
    </div>


    <!--  -->
    <div class="col-md-12 mt-2 mb-2 bg-white card py-3">
        <strong class="py-2">
            <i class="bi bi-receipt-cutoff text-info me-2"></i>
            Mã đơn hàng: <i class="fw-normal">#<?php echo $details[0]['receiptPID'] ?></i>
        </strong>
        <hr style="width: 80%;" class="mx-auto">
        <strong class="py-2">
            <i class="bi bi-person-fill text-info me-2"></i>
            Người nhận: <i class="fw-normal"><?php echo $details[0]['consigneeName'] ?></i>
        </strong>
        <strong class="py-2">
            <i class="bi bi-telephone-fill text-info me-2"></i>
            SĐT: <i class="fw-normal"><?php echo $details[0]['phoneNumber'] ?></i>
        </strong>
        <strong class="py-2">
            <i class="bi bi-geo-alt-fill text-info me-2"></i>
            Địa chỉ giao hàng: <i class="fw-normal"><?php echo $details[0]['deliveryAddress'] ?></i>
        </strong>
        <hr style="width: 80%;" class="mx-auto">
        <strong class="py-2">
            <i class="bi bi-credit-card-fill text-info me-2"></i>
            Phương thức thanh toán: <i class="fw-normal">
                <?php
                if (!$details[0]['paymentMethod'] || $details[0]['paymentMethod'] == 1) {
                    echo 'Giao hàng thu tiền mặt (COD)';
                } else if ($details[0]['paymentMethod'] == 2) {
                    echo 'Ngân hàng nội địa';
                } else if ($details[0]['paymentMethod'] == 3) {
                    echo 'Visa';
                } else if ($details[0]['paymentMethod'] == 4) {
                    echo 'MasterCard';
                } else if ($details[0]['paymentMethod'] == 5) {
                    echo 'ZaloPay';
                }
                ?>
            </i>
        </strong>
        <hr style="width: 80%;" class="mx-auto">
        <strong class="py-2">
            <i class="bi bi-geo-alt-fill text-info me-2"></i>
            Tổng tiền: <i class="fw-normal"><?php echo number_format($total, 0, '.', '.') ?> VNĐ</i>
        </strong>
        <hr style="width: 80%;" class="mx-auto">
        <strong class="py-2">

            <?php
            if (!$details[0]['statusR'] || $details[0]['statusR'] == 0) {
            ?>
                <i class="bi bi-circle-fill text-secondary me-2"></i>Tình trạng đơn hàng: <i class="fw-normal">
                <?php
                echo "Chờ xác nhận";
            } else if ($details[0]['statusR'] == 1) {
                ?>
                    <i class="bi bi-circle-fill text-info me-2"></i>Tình trạng đơn hàng: <i class="fw-normal">
                    <?php
                    echo "Đã xác nhận";
                } else if ($details[0]['statusR'] == 2) {
                    ?>
                        <i class="bi bi-circle-fill text-danger me-2"></i>Tình trạng đơn hàng: <i class="fw-normal">
                        <?php
                        echo "Đã hủy";
                    } else if ($details[0]['statusR'] == 3) {
                        ?>
                            <i class="bi bi-check-circle-fill text-success me-2"></i>Tình trạng đơn hàng: <i class="fw-normal">
                            <?php
                            echo "Đã hoàn thành";
                        }

                            ?></i>
        </strong>

        <div class="col-md-12 d-flex justify-content-end">
            <?php
            if (!$details[0]['statusR'] || $details[0]['statusR'] == 0) {
            ?>
                <div>
                    <a type="button" style="width: fit-content;" class="btn col-1 btn-info ms-auto text-light" href="<?php echo SITEURL ?>employee/confirmReceiptp/<?php echo $details[0]['receiptPID'] ?>"> <i class="bi bi-check2"></i>Xác nhận</a>
                    <a type="button" style="width: fit-content;" class="btn col-1 btn-danger ms-auto text-light" href="<?php echo SITEURL ?>employee/refuseReceiptp/<?php echo $details[0]['receiptPID'] ?>"> <i class="bi bi-x"></i>Hủy</a>
                    
                </div>
            <?php
            } else if ($details[0]['statusR'] == 1) {
            ?>
                <div>
                    <a type="button" style="width: fit-content;" class="btn col-1 btn-danger ms-auto text-light" href="<?php echo SITEURL ?>employee/refuseReceiptp/<?php echo $details[0]['receiptPID'] ?>"> <i class="bi bi-x"></i>Hủy</a>
                    
                </div>
            <?php
            } 
            ?>
            <a type="button" href="<?php echo SITEURL; ?>employee/index" class="btn btn-secondary px-4 ms-1"><i class="bi bi-arrow-return-left"></i>Quay lại</a>
        </div>

    </div>
    <!--  -->

    <!--  -->
    <table class="styled-table">
        <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>Giá tiền</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody id="table-products">
            <!--  -->
            <?php
            foreach ($details as $detail) {
                echo '<tr class="bg-white">';
                echo '<th class="row">';
                echo '<div style="max-width: fit-content;">';
                echo '<img src="' . $detail['imageURL'] . '" alt="" class="product-avatar-list">';
                echo '</div>';
                echo ' <div class="col row d-flex align-items-center">';
                echo '<div class="col-md-12">';
                echo '<b>' . $detail['productName'] . '</b>';
                echo '</div>';
                echo '</div>';
                echo '</th>';
                echo "<th>" . number_format($detail['price'], 0, '.', '.') . "đ</th>";
                echo "<th>{$detail['quantityBuy']}</th>";
                echo "<th>" . number_format($detail['total'], 0, '.', '.') . "đ</th>";
                echo '</tr>';
            }

            ?>
            <!--  -->
        </tbody>
    </table>




</div>

</div>

</div>

</div>
<?php
include _DIR_ROOT . "/app/views/employee/partials/footer.php";
?>
