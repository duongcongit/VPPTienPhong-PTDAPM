<?php
    // if (!isset($_SESSION)) 
    // { 
    //     session_start(); 
    // } 
    // if (!isset($_SESSION['empID'])) {
    //     header("location: ../login/loginView.php");
    // }
    include '../../employees/partials/header.php';
    $receiptps = array(); 
    // include 'partials/loginCheck.php';
?> 
    <div class="col main-right container-fluid row ">
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
                    <th>Người dùng</th>
                    <th>Mã đơn hàng</th>
                    <th>Sản phẩm</th>
                    <th>Tổng đơn hàng</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody id="table-products">
                <!--  -->
                <?php
                foreach($receiptps as $recp)
                {
                echo '<tr>';
                    echo "<th scope='row'>{$recp['username']}</th>";
                    echo "<th scope='row'>{$recp['receiptPID']}</th>";
                    echo '<th class="row">';
                    echo '<div style="max-width: fit-content;">';
                        echo '<img src="../assets/img/products/' . $recp['imageID'] . '" alt="" class="product-avatar-list">';
                    echo '</div>';
                    echo ' <div class="col row d-flex align-items-center">';
                        echo '<div class="col-md-12">';
                            echo '<b>' .$recp['productName']. '</b>';
                        echo '</div>';
                    echo '</div>';
                    echo '</th>';
                    echo "<th>{$recp['total']}</th>";
                    if(!$recp['statusR']){
                        echo '<th>Đang chờ xác nhận</th>';
                    }
                    else if($recp['statusR']==1){
                        echo '<th>Đã xác nhận</th>';
                    }
                    else if($recp['statusR']==2){
                        echo '<th>Đã hủy</th>';
                    }
                    else if($recp['statusR']==3){
                        echo '<th>Đã giao</th>';
                    }
                    
                    
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
include "../../employees/partials/footer.php";
?>