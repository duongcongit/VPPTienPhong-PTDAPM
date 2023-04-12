<?php
    if (!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    if (!isset($_SESSION['adminID'])) {
        // header("location: ./login.php");
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
<div class="alert alert-success alert-dismissible d-flex align-items-center
<?php
if(!isset($_SESSION['editSuccessStatus']))
{
    echo "d-none";
}
?>
 " id="alert-success-pr" role="alert">
    <i class="bi bi-check-circle-fill me-2" width="24" height="24"></i>
    <div>
        <p class="d-inline">
            <?php
            if (isset($_SESSION['editSuccessStatus'])) {
                echo $_SESSION['editSuccessStatus'];
                unset($_SESSION['editSuccessStatus']);
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
                        <span class="pe-3" style="font-size:18px">Tên người dùng</span>
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
                        <span class="pe-3" style="margin-left:80px;font-size:18px">Email</span>
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
                $count_customer = count($customers);
            ?>
            <h3 class="ms-2" id="label-count-prod"><?php echo $count_customer ?> Tài khoản </h3>
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
                    <th>Quyền người dùng</th>
                    <th>Status</th>
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
                    echo '<th>';
                        echo '<a onclick="showConfirmation(' . $user['customerID'] . ')" type="button" class="btn ms-auto text-warning">';
                            echo '<i class="bi bi-gear ms-3" style="font-size:24px"></i>';
                        echo '</a>';
                    echo '</th>';
                    if($user['status']==1){
                        echo '<th><i class="bi bi-check-circle-fill text-success ms-3" style="font-size:24px"></i></th>';
                    }
                    else if($user['status']==2){
                        echo '<th><i class="bi bi-x-circle-fill text-danger ms-3" style="font-size:24px"></i></th>';
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
<!-- Content end-->

<!-- Định nghĩa hộp thoại xác nhận -->
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
