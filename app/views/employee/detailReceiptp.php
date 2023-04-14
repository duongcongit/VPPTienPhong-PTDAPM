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
                <a href="<?php echo SITEURL; ?>employee/index">Trang nhân viên</a> / </span>
                <a href="<?php echo SITEURL; ?>employee/index">Quản lý đơn hàng</a> / </span>
                <a href="<?php echo SITEURL; ?>employee/detail/<?php echo $detail['receiptPID'] ?>">Chi tiết đơn hàng</a>
            </h5>
        </div>
        <div class="col-md-12 mt-4 mb-3 bg-white card">
            <p>Người nhận: <?php echo $details[0]['consigneeName'] ?></p>
            <p>Số điện thoại: <?php echo $details[0]['phoneNumber'] ?></p>
            <p>Địa chỉ nhận: <?php echo $details[0]['deliveryAddress'] ?></p>
        </div>oke
        <!--  -->
        <table class="styled-table ">
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Giá tiền</th>
                    <th>Số lượng</th>
                    <th>Tổng tiền</th>
                </tr>
            </thead>
            <tbody id="table-products">
                <!--  -->
                <?php
                foreach($details as $detail)
                {
                echo '<tr class="bg-white">';
                    echo '<th class="row">';
                    echo '<div style="max-width: fit-content;">';
                        echo '<img src="'.$detail['imageURL'].'" alt="" class="product-avatar-list">';
                    echo '</div>';
                    echo ' <div class="col row d-flex align-items-center">';
                        echo '<div class="col-md-12">';
                            echo '<b>' .$detail['productName']. '</b>';
                        echo '</div>';
                    echo '</div>';
                    echo '</th>';
                    echo "<th>{$detail['price']}</th>";
                    echo "<th>{$detail['quantityBuy']}</th>";
                    echo "<th>{$detail['total']}</th>";
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
include _DIR_ROOT."/app/views/employee/partials/footer.php";
?>