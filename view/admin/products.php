<?php
    if (!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    if (!isset($_SESSION['adminID'])) {
        header("location: ./login.php");
    }
    include "partials/loginCheck.php";
    include 'partials/headerAdmin.php';

?>

<!-- Content start-->
<div class="col main-right container-fluid row ">

<div class="col-md-12 mt-2 mb-3 nav-page">
    <h5 class="text-muted"><a href="../index.php">Trang quản trị</a> / </span><a href="">Quản lý sản phẩm</a></h5>
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
            if (isset($_SESSION['successAddProduct'])) {
                echo $_SESSION['successAddProduct'];
                unset($_SESSION['successAddProduct']);
            }
            if (isset($_SESSION['errorAddProduct'])) {
                echo $_SESSION['errorAddProduct'];
                unset($_SESSION['errorAddProduct']);
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
                <a type="button" class="nav-mng-product nav-link active" style="font-size:20px">Tất cả</a>
            </li>
            <li class="nav-item">
                <a type="button" class="nav-mng-product nav-link" style="font-size:20px">Hết hàng</a>
            </li>
        </ul>
        <hr class="mt-0">
    </div>

    <div class="col-md-12 products-search">
        <form>
            <div class="input-group mb-3">
                <div class="col-md-12 col-lg-6 pe-4">
                    <div class="input-group mb-3" style="margin-left:60px">
                        <span class="pe-3" style="font-size:18px">Tên sản phẩm</span>
                        <input id="productNameSearch" type="text" class="form-control" placeholder="Nhập vào">
                    </div>
                </div>
                <div class="col-md-12 col-lg-7 pe-4">
                    <div class="input-group mb-3" style="margin-left:8px">
                        <span class="pe-3" style="font-size:18px">Danh mục sản phẩm</span>
                        <input type="text" class="form-control" placeholder="Nhập vào">
                    </div>
                </div>
                <div class="col-md-12 col-lg-6 pe-4">
                    <div class="input-group mb-3" style="margin-left:26px">
                        <span class="pe-3" dir="rtl" style="min-width: 161px;">Đã bán</span>
                        <input type="text" class="form-control" placeholder="Nhập vào">
                        <p class="text-muted px-2">__</p>
                        <input type="text" class="form-control" placeholder="Nhập vào">
                    </div>
                </div>
            </div>

            <button class="btn btn-danger px-4" style="margin-left:182px">Tìm</button>
            <button class="btn btn-secondary px-4">Nhập lại</button>
    </div>

    <div class="col-md-12 mt-3">
        <div class="d-flex justify-content-between">
            <?php
            //Count Rows
            $count_products = count($products);
            ?>
            <h3 class="ms-2" id="label-count-prod"><?php echo $count_products ?> Sản phẩm </h3>
            <div class="box-button">
                <a type="button" href="./addProductCate.php" class="btn ms-auto text-white bg-success"><i class="bi bi-plus-circle-fill"></i> Thêm loại hàng</a>
                <a type="button" href="./addProduct.php" class="btn btn-info ms-auto text-white"><i class="bi bi-plus-circle-fill me-1"></i> Thêm 1 sản phẩm mới</a>
            </div>
        </div>
        <!--  -->
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Mã SP</th>
                    <th>Loại sản phẩm</th>
                    <th>Giá</th>
                    <th>Kho hàng</th>
                    <th>Đã bán</th>
                    <th>Sửa thông tin</th>
                    <th>Xóa</th>
                </tr>
            </thead>
            <tbody id="table-products">
            
            <?php
                foreach($products as $product)
                {
                echo '<tr>';
                    echo '<th class="row">';
                    echo '<div style="max-width: fit-content;">';
                        echo '<img src="'.$product['image1'].'" alt="" class="product-avatar-list">';
                    echo '</div>';
                    echo ' <div class="col row d-flex align-items-center">';
                        if ($product['status'] == 1 and $product['stock'] > 0) {
                                echo '<div class="col-md-12 produc-status-active">';
                               echo ' Đang hoạt động';
                            echo '</div>';
                        }

                        if ($product['status'] == 1 and $product['stock'] == 0) {
                            echo '<div class="col-md-12 produc-status-out">';
                               echo 'Hết hàng';
                            echo '</div>';
                        }

                        if ($product['status'] == 3) {
                            echo '<div class="col-md-12 produc-status-locked">';
                                echo 'Bị khóa';
                            echo '</div>';
                        }

                        echo '<div class="col-md-12">';
                            echo '<b>' .$product['productName']. '</b>';
                        echo '</div>';
                    echo '</div>';
                    echo '</th>';

                    echo '<th>'. $product['productID']. '</th>';
                    echo '<th>'. $product['name']. '</th>';
                    echo '<th>'. $product['price']. '</th>';
                    echo '<th>'. $product['stock']. '</th>';
                    echo '<th>'. $product['sold']. '</th>';
                    //Sửa thông tin NCC
                    echo "<th>";
                    echo '<a onclick="return confirm(\'Bạn muốn sửa thông tin sản phẩm ' . $product['productName'] . ' ?\')" type="button" class="btn text-warning " href="updateProduct.php?id=' . $product['productID'] . '">';
                    echo '<i class="bi bi-pencil-square text-primary" style="font-size:20px"></i>';
                    echo '</a>';
                    echo '</th>';

                    //Xóa NCC
                    echo "<th>";
                        echo '<a onclick="return confirm(\'Bạn có chắc chắn muốn xóa sản phẩm ' . $product['productName'] . ' ?\')" type="button" class="btn ms-auto text-warning" href="deleteProduct.php?id=' . $product['productID'] . '">';
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

<!-- Định nghĩa hộp thoại xác nhận thêm loại hàng -->
<div id="confirmation-dialog">
    <div id="confirmation-dialog-content">
        <p>Bạn thay trạng thái cho người dùng này thế nào:</p>
        <div>
            <input type="radio" id="choice1" name="choice" value="1">
            <label for="choice1">Hoạt động bình thường</label>
        </div>
        <div>
            <input type="radio" id="choice2" name="choice" value="2">
            <label for="choice2">Khóa tài khoản</label>
        </div>
        <div id="confirmation-dialog-buttons">
            <button type="button" onclick="confirmAction()">Xác nhận</button>
            <button type="button" onclick="hideConfirmation()">Hủy</button>
        </div>
    </div>
</div>

<script>
    var elementId=0;
    
    // Load the data first
    window.addEventListener('DOMContentLoaded', function() {
        // Code to load data goes here
        // Once the data is loaded, attach event listeners to the confirmation buttons
        var confirmationButtons = document.querySelectorAll('.confirmation-button');
        for (var i = 0; i < confirmationButtons.length; i++) {
            confirmationButtons[i].addEventListener('click', showConfirmation);
        }
    });

    function showConfirmation(customerID) {
        elementId = customerID;
        document.getElementById("confirmation-dialog").style.display = "block";
        console.log(elementId);
    }

    function hideConfirmation() {
        document.getElementById("confirmation-dialog").style.display = "none";
        elementId = 0;
    }

    function confirmAction() {
        var choice = document.querySelector('input[name="choice"]:checked');
        var id = elementId;
        if (choice) {
            window.location.href = "changeStatusCustomer.php?id="+ id + "&choice=" + choice.value;
            hideConfirmation();
        } else {
            alert("Vui lòng chọn một lựa chọn.");
        }
    }
</script>

<?php
include "partials/footerAdmin.php";
?>