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
    <h5 class="text-muted"><a href="./index.php">Trang quản trị</a> / </span><a href="">Quản lý nhân viên</a></h5>
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
if (!isset($_SESSION['successAddEmployee'])&&!isset($_SESSION['errorAddEmployee'])&&!isset($_SESSION['successDeleteEmployee'])&&!isset($_SESSION['errorDeleteEmployee'])&&!isset($_SESSION['successUpdateEmployee'])&&!isset($_SESSION['errorUpdateEmployee'])&&!isset($_SESSION['successDeleteAllEmployee'])&&!isset($_SESSION['errorDeleteAllEmployee'])) {
    echo "d-none";
}
?>
 " id="alert-success-pr" role="alert">
    <i class="bi bi-check-circle-fill me-2" width="24" height="24"></i>
    <div>
        <p class="d-inline">
        <?php
            if (isset($_SESSION['successAddEmployee'])) {
                echo $_SESSION['successAddEmployee'];
                unset($_SESSION['successAddEmployee']);
            }

            if (isset($_SESSION['errorAddEmployee'])) {
                echo $_SESSION['errorAddEmployee'];
                unset($_SESSION['errorAddEmployee']);
            }

            if (isset($_SESSION['successDeleteEmployee'])) {
                echo $_SESSION['successDeleteEmployee'];
                unset($_SESSION['successDeleteEmployee']);
            }

            if (isset($_SESSION['errorDeleteEmployee'])) {
                echo $_SESSION['errorDeleteEmployee'];
                unset($_SESSION['errorDeleteEmployee']);
            }

            if (isset($_SESSION['successUpdateEmployee'])) {
                echo $_SESSION['successUpdateEmployee'];
                unset($_SESSION['successUpdateEmployee']);
            }

            if (isset($_SESSION['errorUpdateEmployee'])) {
                echo $_SESSION['errorUpdateEmployee'];
                unset($_SESSION['errorUpdateEmployee']);
            }

            if (isset($_SESSION['successDeleteAllEmployee'])) {
                echo $_SESSION['successDeleteAllEmployee'];
                unset($_SESSION['successDeleteAllEmployee']);
            }

            if (isset($_SESSION['errorDeleteAllEmployee'])) {
                echo $_SESSION['errorDeleteAllEmployee'];
                unset($_SESSION['errorDeleteAllEmployee']);
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
                        <span class="pe-3" style="font-size:18px">Mã nhân viên</span>
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
                        <span class="pe-3" style="margin-left:-1px;font-size:18px">Tên nhân viên</span>
                        <input type="text" class="form-control" placeholder="Nhập vào">
                    </div>
                </div>
                <div class="col-md-12 col-lg-3 pe-4">
                    <button class="btn btn-secondary px-4">Nhập lại</button>
                </div>
            </div>
        </form>
    </div>

    <div class="col-md-12">
        <div class="d-flex justify-content-between">
            <?php
                //Count Rows
                $count_employee = count($employees);
            ?>
            <h3 class="ms-2" id="label-count-prod"><?php echo $count_employee ?> Tài khoản </h3>
            <a type="button"  href="./addEmployee.php" class="btn btn-primary ms-auto">
                <i class="bi bi-plus-circle-fill me-1"></i>Thêm
            </a>
            <a type="button"  href="./deleteAllEmployee.php" onclick="return confirm('Bạn có chắc chắn muốn xóa toàn bộ nhân viên? ')" class="btn btn-danger ms-3">
                <i class="bi bi-trash-fill me-1"></i>Xóa toàn bộ nhân viên
            </a>
        </div>
        <!--  -->
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Mã NV</th>
                    <th>Họ Tên</th>
                    <th>Giới tính</th>
                    <th>SDT</th>
                    <th>Địa chỉ</th>
                    <th>Email</th>
                    <th>Tên tài khoản</th>
                    <th>Mật khẩu</th>
                    <th>Trạng thái</th>
                    <th>Sửa</th>
                    <th>Xóa</th>
                </tr>
            </thead>
            <tbody id="table-products">
                <!--  -->
                <?php
                foreach($employees as $employee)
                {
                echo '<tr>';
                    echo "<th scope='row'>{$employee['employeeID']}</th>";
                    echo "<th>{$employee['fullname']}</th>";
                    echo "<th>{$employee['gender']}</th>";
                    echo "<th>{$employee['phone']}</th>";
                    echo "<th>{$employee['address']}</th>";
                    echo "<th>{$employee['email']}</th>";
                    echo "<th>{$employee['username']}</th>";
                    echo "<th>{$employee['password']}</th>";
                    if($employee['status']==1){
                        echo '<th><i class="bi bi-check-circle-fill text-success ms-3" style="font-size:24px"></i></th>';
                    }
                    else if($employee['status']==2){
                        echo '<th><i class="bi bi-x-circle-fill text-danger ms-3" style="font-size:24px"></i></th>';
                    }
                    
                    //Sửa thông tin NCC
                    echo "<th>";
                    echo '<a onclick="return confirm(\'Bạn muốn sửa thông tin nhân viên ' . $employee['fullname'] . ' ?\')" type="button" class="btn text-warning " href="updateEmployee.php?id=' . $employee['employeeID'] . '">';
                        echo '<i class="bi bi-pencil-square text-primary" style="font-size:20px"></i>';
                    echo '</a>';
                    echo '</th>';
                    
                     //Xóa NCC
                    echo "<th>";
                    echo '<a onclick="return confirm(\'Bạn có chắc chắn muốn xóa nhân viên ' . $employee['fullname'] . ' ?\')" type="button" class="btn ms-auto text-warning" href="deleteEmployee.php?id=' . $employee['employeeID'] . '">';
                         echo '<i class="bi bi-trash text-danger" style="font-size:20px"></i>';
                    echo '</a>';
                    echo '</th>';
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
