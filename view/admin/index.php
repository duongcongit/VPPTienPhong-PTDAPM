<?php
    if (!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    if (!isset($_SESSION['adminID'])) {
        header("location: ./login.php");
    }
    include 'partials/headerAdmin.php';
    include 'partials/loginCheck.php';
?> 

<!-- Content start-->
<div class="col main-right container-fluid row mt-0">

<div class="col-md-12 mt-2 mb-3 nav-page">
    <h5 class="text-muted"><a href="./index.php">Trang quản trị</a> / </span><a href="">Quản lý tài khoản người dùng</a></h5>
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

    <div class="col-md-12">
        <div class="d-flex justify-content-between">
            <?php
                //Count Rows
                $count_customer = count($customers);
            ?>
            <h3 class="ms-2" id="label-count-prod"><?php echo $count_customer ?> Tài khoản </h3>
            <a type="button"  href="processDeleteAllAcc.php" onclick="return confirm('Xóa tài khoản sẽ xóa hết sản phẩm và giỏ hàng của tài khoản! Bạn có chắc chắn muốn xóa? ')" class="btn btn-danger ms-auto">
                <i class="bi bi-trash-fill me-1"></i>Xóa tất cả các tài khoản
            </a>
        </div>
        <!--  -->
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Mã khách</th>
                    <th>Họ Tên</th>
                    <th>SDT</th>
                    <th>Địa chỉ</th>
                    <th>Email</th>
                    <th>Tên tài khoản</th>
                    <th>Xóa tài khoản</th>
                </tr>
            </thead>
            <tbody id="table-products">
                <!--  -->
                <?php
                foreach($customers as $user)
                {
                echo '<tr>';
                    echo "<th scope='row'>{$user['customerID']}</th>";
                    echo "<th>{$user['fullname']}</th>";
                    echo "<th>{$user['phone']}</th>";
                    echo "<th>{$user['address']}</th>";
                    echo "<th>{$user['email']}</th>";
                    echo "<th>{$user['username']}</th>";
                    /*
                    echo "<th><a href='$urlEdit'><i class='bi bi-pencil-square'></i></a></th>";
                    echo "<th><a href='$urlDelete'></i><i class='bi bi-trash'></i></a></th>";  
                    <th>
                    <a onclick="return confirm('Xóa tài khoản sẽ xóa hết sản phẩm và giỏ hàng của tài khoản! Bạn có chắc chắn muốn xóa? ')" type="button"  class="btn ms-auto text-warning" 
                        href="processDeleteAcc.php?id=<?php echo $row['id']; ?>">
                        <i class="bi bi-trash"></i> 
                    </a>
                    </th>     
                    */  
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
include "partials/footerAdmin.php";
?>
