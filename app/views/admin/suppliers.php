<?php
    if (!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    if (!isset($_SESSION['adminID'])) {
        header("location: " .SITEURL."admin/login");
    }
    include 'partials/headerAdmin.php';
?> 

<!-- Content start-->
<div class="col main-right container-fluid row ">


<div class="col-md-12 mt-2 mb-3 nav-page">
    <h5 class="text-muted"><a href="./index">Trang quản trị hệ thống</a> / </span><a href="">Quản lý nhà cung cấp</a></h5>
</div>

<!-- Thông báo thêm NCC thành công  -->
<div class="alert alert-success alert-dismissible d-flex align-items-center 
<?php
if (!isset($_SESSION['successAddSupplier'])&&!isset($_SESSION['errorAddSupplier'])&&!isset($_SESSION['successDeleteSupplier'])&&!isset($_SESSION['errorDeleteSupplier'])&&!isset($_SESSION['successUpdateSupplier'])&&!isset($_SESSION['errorUpdateSupplier'])&&!isset($_SESSION['successDeleteAllSupplier'])&&!isset($_SESSION['errorDeleteAllSupplier'])) {
    echo "d-none";
}
?>
 " id="alert-success-pr" role="alert">
    <i class="bi bi-check-circle-fill me-2" width="24" height="24"></i>
    <div>
        <p class="d-inline">
            <?php
            if (isset($_SESSION['successAddSupplier'])) {
                echo $_SESSION['successAddSupplier'];
                unset($_SESSION['successAddSupplier']);
            }

            if (isset($_SESSION['errorAddSupplier'])) {
                echo $_SESSION['errorAddSupplier'];
                unset($_SESSION['errorAddSupplier']);
            }

            if (isset($_SESSION['successDeleteSupplier'])) {
                echo $_SESSION['successDeleteSupplier'];
                unset($_SESSION['successDeleteSupplier']);
            }

            if (isset($_SESSION['errorDeleteSupplier'])) {
                echo $_SESSION['errorDeleteSupplier'];
                unset($_SESSION['errorDeleteSupplier']);
            }

            if (isset($_SESSION['successUpdateSupplier'])) {
                echo $_SESSION['successUpdateSupplier'];
                unset($_SESSION['successUpdateSupplier']);
            }

            if (isset($_SESSION['errorUpdateSupplier'])) {
                echo $_SESSION['errorUpdateSupplier'];
                unset($_SESSION['errorUpdateSupplier']);
            }

            if (isset($_SESSION['successDeleteAllSupplier'])) {
                echo $_SESSION['successDeleteAllSupplier'];
                unset($_SESSION['successDeleteAllSupplier']);
            }

            if (isset($_SESSION['errorDeleteAllSupplier'])) {
                echo $_SESSION['errorDeleteAllSupplier'];
                unset($_SESSION['errorDeleteAllSupplier']);
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
                <a type="button" class="nav-mng-product nav-link active" style="font-size:20px">Tất cả tài khoản</a>
            </li>
        </ul>
        <hr class="mt-0">
    </div>

    <div class="col-md-12 products-search">
        <form>
            <div class="input-group col-md-12 mb-3">
                <div class=" col-lg-6 pe-4">
                    <div class="input-group mb-3">
                        <span class="pe-3" style="margin-left:72px;font-size:18px">Mã NCC</span>
                        <input id="customerAddSearch" type="text" class="form-control" placeholder="Nhập vào" >
                    </div>
                </div>
                <div class="col-md-12 col-lg-3 pe-4">
                    <button class="btn btn-danger" style="padding-left:2.5rem;padding-right:2.5rem">Tìm</button>
                </div>
            </div>

            <div class="input-group col-md-12 mb-3">
                <div class=" col-lg-6 pe-4" >  
                    <div class="input-group mb-3">
                        <span class="pe-3" style="margin-left:-1px;font-size:18px">Tên nhà cung cấp</span>
                        <input type="text" class="form-control" placeholder="Nhập vào">
                    </div>
                </div>
                <div class="col-md-12 col-lg-3 pe-4">
                    <button class="btn btn-secondary px-4">Nhập lại</button>
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
            <a type="button"  href="./addSupplier" class="btn btn-primary ms-auto">
                <i class="bi bi-plus-circle-fill me-1"></i>Thêm nhà cung cấp
            </a>
            <!-- <a type="button"  href="./deleteAllSupplier" onclick="return confirm('Bạn có chắc chắn muốn xóa tất cả nhà cung cấp?')" class="btn btn-danger ms-3">
                <i class="bi bi-trash-fill me-1"></i>Xóa toàn bộ NCC
            </a> -->
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
                    <th>Sửa tài khoản</th>
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
                                echo "<th>{$supplier["supplierName"]}</th>";
                                echo "<th>{$supplier['phone']}</th>";
                                echo "<th>{$supplier['address']}</th>";
                                echo "<th>{$supplier['email']}</th>";
                                //Sửa thông tin NCC
                                echo "<th>";
                                echo '<a onclick="return confirm(\'Bạn muốn sửa thông tin nhà cung cấp ' . $supplier['supplierName'] . ' ?\')" type="button" class="btn text-warning " href="updateSupplier?id=' . $supplier['supplierID'] . '">';
                                    echo '<i class="bi bi-pencil-square text-primary" style="font-size:20px"></i>';
                                echo '</a>';
                                echo '</th>';

                                //Xóa NCC
                                echo "<th>";
                                echo '<a onclick="return confirm(\'Bạn có chắc chắn muốn xóa nhà cung cấp ' . $supplier['supplierName'] . ' ?\')" type="button" class="btn ms-auto text-warning" href="deleteSupplier?id=' . $supplier['supplierID'] . '">';
                                    echo '<i class="bi bi-trash text-danger" style="font-size:20px"></i>';
                                echo '</a>';
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
<!-- Content end-->

<?php
if (isset($_SESSION['errorDeleteSupplierProduct'])) {
    echo '<div id="confirmation-dialog-1" class="show">';
    unset($_SESSION['errorDeleteSupplierProduct']);
} else {
    echo '<div id="confirmation-dialog-1">';
}
?>
    <!-- Định nghĩa hộp thoại thông báo -->
    <div id="confirmation-dialog-content">
        <i class="bi bi-exclamation-triangle text-warning ms-3" style="font-size:30px"></i>
        <b>Nhà cung cấp này hiện đang cung cấp sản phẩm. Vui lòng xóa các sản phẩm có mã nhà cung cấp này trước rồi thực hiện hành động này</b>
    </div>
    <div id="confirmation-dialog-buttons">
        <button type="button" onclick="hideConfirmation()">Hủy</button>
    </div>
</div>

<!-- Check -->
<script>
    function hideConfirmation() {
        var confirmationDialog = document.getElementById("confirmation-dialog-1");
        confirmationDialog.style.display = "none";
        confirmationDialog.classList.remove("show");
    }
</script>

<?php
include "partials/footerAdmin.php";
?>
