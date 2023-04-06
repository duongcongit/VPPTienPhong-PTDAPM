<?php
    if (!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    if (!isset($_SESSION['adminID'])) {
        header("location: ./login.php");
    }
    include "./partials/loginCheck.php";
    include './partials/headerAdmin.php';
?> 

<!-- Content start-->
<div class="col main-right container-fluid row ">

<!-- Modal edit stock start -->
<!-- <div class="modal fade" id="modalUpdateStock" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"> -->
<div class="modal fade" id="modalUpdateStock" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <i class="bi bi-pencil me-2 fs-4 text-danger"></i>
                <h5 class="modal-title me-auto" id="staticBackdropLabel">Cập nhật tình trạng kho hàng</h5>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
            </div>
            <div class="modal-body">
                <div class="input-group mb-3">
                    <span class="ms-2 me-3 pt-2">Kho hàng</span>
                    <input id="stockUpdateInput" type="text" class="form-control" placeholder="0" autocomplete="off">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <button type="button" class="btn btn-primary" id="stockUpdateConf">Cập nhật</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal edit stock end -->

<div class="col-md-12 mt-2 mb-3 nav-page">
    <h5 class="text-muted"><a href="./index.php">Trang quản trị</a> / </span><a href="">Quản lý nhà cung cấp</a></h5>
</div>
<!--  -->
<div class="alert alert-success alert-dismissible alert-update-success d-flex align-items-center d-none" role="alert">
    <i class="bi bi-check-circle-fill me-2" width="24" height="24"></i>
    <div>
        <p id="alert-success-content" class="d-inline"></p><strong id="alert-success-taget"></strong><span> thành công!</span>
    </div>
    <button type="button" class="btn-close" onclick="removeAlert()"></button>
    <script>
        function removeAlert() {
            $(".alert-update-success").addClass("d-none");
        }
    </script>
</div>


<!--  -->
<div class="alert alert-success alert-dismissible d-flex align-items-center 
<?php
if (!isset($_SESSION['editProdSucsess']) && !isset($_SESSION['addProdSucsess']) && !isset($_SESSION['upProdStockSucsess'])) {
    echo "d-none";
}
?>
 " id="alert-success-pr" role="alert">
    <i class="bi bi-check-circle-fill me-2" width="24" height="24"></i>
    <div>
        <p class="d-inline">
            <?php
            if (isset($_SESSION['addProdSucsess'])) {
                echo $_SESSION['addProdSucsess'];
                unset($_SESSION['addProdSucsess']);
            }
            if (isset($_SESSION['editProdSucsess'])) {
                echo $_SESSION['editProdSucsess'];
                unset($_SESSION['editProdSucsess']);
            }
            ?>
        </p>
    </div>
    <button type="button" class="btn-close" onclick="rmAlert()"></button>
    <script>
        function rmAlert() {
            $("#alert-success-pr").addClass("d-none");
        }
    </script>
</div>
<!--  -->
<div class="col-md-12 manage-products shadow">
    <div class="col-md-12">
        <ul class="nav">
            <li class="nav-item">
                <a type="button" class="nav-mng-product nav-link active <?php echo ($tableType == "all" ? "active" : "") ?>">Tất cả</a>
            </li>
            <li class="nav-item">
                <a type="button" class="nav-mng-product nav-link <?php echo ($tableType == "active" ? "active" : "") ?>">Đang hoạt động</a>
            </li>
            <li class="nav-item">
                <a type="button" class="nav-mng-product nav-link <?php echo ($tableType == "locked" ? "active" : "") ?>">Bị khóa</a>
            </li>
        </ul>
        <hr class="mt-0">
    </div>

    <div class="col-md-12 products-search">
        <form>
            <div class="input-group col-md-12 mb-3">
                <div class=" col-lg-6 pe-4">
                    <div class="input-group mb-3">
                        <select class="form-select select-ten">
                            <option value="0" selected>Tên người dùng</option>
                            <option value="1">Mã người dùng</option>
                        </select>
                        <input id="productNameSearch" type="text" class="form-control" placeholder="Nhập vào">
                    </div>
                </div>
                <div class="col-md-12 col-lg-3 pe-4">
                    <button class="btn btn-danger px-4">Tìm</button>
                    <button class="btn btn-secondary px-4">Nhập lại</button>
                </div>
            </div>
            <div class="col-md-12 col-lg-6 pe-4">
                    <div class="input-group mb-3">
                        <span class="pe-3">Email</span>
                        <input type="email" class="form-control" placeholder="Chọn danh mục sản phẩm">
                    </div>
                </div>
            
        </form>
    </div>

    <div class="col-md-12 mt-3">
        <div class="d-flex justify-content-between">
            <?php
            $count_suppliers = count($suppliers);
            ?>
            <h3 class="ms-2" id="label-count-prod"><?php echo $count_suppliers ?> Tài khoản </h3>
            <a type="button"  href="processDeleteAllAcc.php" onclick="return confirm('Xóa tài khoản sẽ xóa hết sản phẩm và giỏ hàng của tài khoản! Bạn có chắc chắn muốn xóa? ')" class="btn btn-danger ms-auto">
                <i class="bi bi-trash-fill me-1"></i>Thêm
            </a>
            <a type="button"  href="processDeleteAllAcc.php" onclick="return confirm('Xóa tài khoản sẽ xóa hết sản phẩm và giỏ hàng của tài khoản! Bạn có chắc chắn muốn xóa? ')" class="btn btn-danger ms-3">
                <i class="bi bi-trash-fill me-1"></i>Sửa
            </a>
            <a type="button"  href="processDeleteAllAcc.php" onclick="return confirm('Xóa tài khoản sẽ xóa hết sản phẩm và giỏ hàng của tài khoản! Bạn có chắc chắn muốn xóa? ')" class="btn btn-danger ms-3">
                <i class="bi bi-trash-fill me-1"></i>Xóa
            </a>
        </div>
        <!--  -->
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Mã NCC</th>
                    <th>Tên NCC</th>
                    <th>SDT</th>
                    <th>Địa chỉ</th>
                    <th>Email</th>
                    <th>Xóa tài khoản</th>
                </tr>
            </thead>
            <tbody id="table-products">
                <!--  -->
                <?php
                    foreach($suppliers as $supplier)
                        {
                            echo '<tr>';
                            echo "<th scope='row'>{$supplier['supplierID']}</th>";
                            echo "<th>{$supplier['supplierName']}</th>";
                            echo "<th>{$supplier['phone']}</th>";
                            echo "<th>{$supplier['address']}</th>";
                            echo "<th>{$supplier['email']}</th>";
                            echo '</tr>';
                        }    
                ?> 
                <!--  -->
            </tbody>
        </table>
        <!--  -->
    </div>

</div>
<!-- Content end-->

<?php
include "./partials/footerAdmin.php";
?>
