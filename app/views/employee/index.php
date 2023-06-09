<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['empID'])) {
    header("Location:" . SITEURL . "employee/login");
}
include _DIR_ROOT . '/app/views/employee/partials/header.php';
?>
<div class="col main-right container-fluid row ">
    <div class="col-md-12 mt-4 mb-3 nav-page">
        <h5 class="text-muted"><a href="">Trang nhân viên</a> / </span><a href="">Quản lý đơn hàng</a></h5>
    </div>
    <form>
        <div class="input-group col-md-12 mt-5 mb-2">
            <div class=" col-lg-6 pe-4">
                <div class="input-group mb-3">
                    <select class="form-select select-ten">
                        <option value="0" selected>Mã đơn hàng</option>
                        <option value="1">Tên khách hàng</option>
                    </select>
                    <input id="productNameSearch" type="text" class="form-control" placeholder="Nhập vào">
                </div>
            </div>
            <div class="col-md-12 col-lg-3 pe-4">
                <button class="btn btn-danger px-4"><i class="bi bi-search ms-auto"></i>Tìm kiếm</button>
            </div>
        </div>
    </form>
    <!--  -->
    <table class="styled-table ">
        <thead>
            <tr>
                <th>Mã đơn hàng</th>
                <th>Khách hàng</th>
                <th>Số sản phẩm</th>
                <th>Tổng tiền</th>
                <th>Phương thức thanh toán</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
                <th>Chi tiết</th>
            </tr>
        </thead>
        <tbody id="table-products">
            <!--  -->
            <?php
            foreach ($receiptps as $recp) {
                echo '<tr class="bg-white">';
                echo "<th scope='row'>#{$recp['receiptPID']}</th>";
                echo "<th scope='row'>{$recp['fullname']}</th>";
                echo "<th scope='row'>{$recp['tongSanPham']}</th>";
                echo "<th>" . number_format($recp['tongTien'], 0, '.', '.') . "đ</th>";
                echo '<th>';
                if (!$recp['paymentMethod'] || $recp['paymentMethod'] == 1) {
                    echo '<p class= "text-primary mb-auto">Tiền mặt (COD)</p>';
                } else if ($recp['paymentMethod'] == 2) {
                    echo '<p class= "text-primary mb-auto">Ngân hàng nội địa</p>';
                } else if ($recp['paymentMethod'] == 3) {
                    echo '<p class= "text-primary mb-auto">Visa</p>';
                } else if ($recp['paymentMethod'] == 4) {
                    echo '<p class= "text-primary mb-auto">MasterCard</p>';
                } else if ($recp['paymentMethod'] == 5) {
                    echo '<p class= "text-primary mb-auto">ZaloPay</p>';
                }
                echo '</th>';
                echo '<th>';
                if (!$recp['statusR']) {
                    echo '<p class= "text-secondary mb-auto">Đang chờ xác nhận</p>';
                } else if ($recp['statusR'] == 1) {
                    echo '<p class= "text-success mb-auto">Đã xác nhận</p>';
                } else if ($recp['statusR'] == 2) {
                    echo '<p class= "text-danger mb-auto">Đã hủy</p>';
                } else if ($recp['statusR'] == 3) {
                    echo '<p class= "text-success mb-auto">Đã giao</p>';
                }
                echo '</th>';
                if (!$recp['statusR'] || $recp['statusR'] == 0) {
                    echo '<th>';
                        echo '<a onclick="return confirm(\'Bạn muốn xác nhận đơn hàng ' . $recp['receiptPID'] . ' chứ?\')" type="button"  class="btn ms-auto text-success" href="'.SITEURL.'employee/confirmReceiptp/'.$recp['receiptPID'].'"> <i class="bi bi-check2"></i>Xác nhận</a>';
                        echo '<a onclick="return confirm(\'Bạn muốn hủy đơn hàng ' . $recp['receiptPID'] . ' chứ?\')" type="button"  class="btn ms-auto text-danger" href="'.SITEURL.'employee/refuseReceiptp/'.$recp['receiptPID'].'"> <i class="bi bi-x"></i>Hủy</a>';
                        echo '</th>';
                } else if ($recp['statusR'] == 1) {
                    echo '<th>';
                    echo '<a onclick="return confirm(\'Bạn muốn hủy đơn hàng ' . $recp['receiptPID'] . ' chứ?\')" type="button"  class="btn ms-auto text-danger" href="'.SITEURL.'employee/refuseReceiptp/'.$recp['receiptPID'].'"> <i class="bi bi-x"></i>Hủy</a>';
                    echo '</th>';
                    
                }else{
                    echo '<th>';
                    echo '<a onclick="return confirm(\'Bạn muốn xác nhận đơn hàng ' . $recp['receiptPID'] . ' chứ?\')" type="button"  class="btn ms-auto text-success" href="'.SITEURL.'employee/confirmReceiptp/'.$recp['receiptPID'].'"> <i class="bi bi-check2"></i>Xác nhận</a>';
                    echo '</th>';
                }
                echo '<th>';
                echo '<a type="button"  class="btn ms-auto text-primary" href="' . SITEURL . 'employee/detail/' . $recp['receiptPID'] . '"> <i class="bi bi-info"></i>Xem chi tiết</a>';
                echo '</th>';

                echo '</tr>';
            }

            ?>
            <!--  -->
        </tbody>
    </table>
    <!--  -->
</div>

</div>

</div>

</div>
<?php
include _DIR_ROOT . "/app/views/employee/partials/footer.php";
?>