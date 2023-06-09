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

<!--  -->
<div class="col-md-12 mt-2 mb-3 nav-page">
    <h5 class="text-muted"><a href="">Trang quản trị hệ thống</a> / <a href="">Quản lý nhân viên</a> / <b href="">Sửa thông tin nhân viên</b></h5>
</div>
<!--  -->
<div class="col-md-12 manage-products shadow">
    <div class="col-md-12">
        <span>
            <strong class="fs-4 ms-2 nav-link text-danger">Thông tin nhân viên</strong>
        </span>
    </div>
    <!--  -->
    <div class="col-md-12 d-flex justify-content-center">
        <div class="col-md-11">
            <hr>
            <form method="POST" action="updateEmployeeProcess" enctype="multipart/form-data" autocomplete="off">
                <div class="basic-info col-md-12">
                    <div class="input-group mb-3 mt-5">
                        <div class="col-md-3 pe-4">
                            <div class="input-group mb-3">
                                <span class="pe-3" dir="rtl" style="min-width: 161px;font-weight: 500;"> Mã nhân viên</span>
                                <input name="idEmployee" readonly type="text" class="form-control" placeholder="" value='<?php echo $employee['employeeID'] ?>'>
                            </div>
                        </div>

                        <div class="col-md-12 pe-4" style="margin-bottom:16px">
                            <div class="input-group mb-3">
                                <span class="pe-3" dir="rtl" style="margin-left:76px;font-weight: 500;">Status</span>
                                <?php
                                if($employee['status']=='1'){
                                    echo '<label>';
                                        echo '<input type="radio" name="statusEmployee" style="margin-left:25px" value="1" checked required> Bình thường';
                                    echo '</label>';
                                    echo '<label>';
                                        echo '<input type="radio" name="statusEmployee" class="ms-3" value="2" required> Khóa';
                                    echo '</label>';
                                }
                                else{
                                    echo '<label>';
                                        echo '<input type="radio" name="statusEmployee" style="margin-left:25px" value="1" required> Bình thường';
                                    echo '</label>';
                                    echo '<label>';
                                        echo '<input type="radio" name="statusEmployee" checked class="ms-3" value="2" required> Khóa';
                                    echo '</label>';
                                }
                                ?>
                            </div>
                        </div>

                        <div class="col-md-12 pe-4">
                            <div class="input-group mb-3">
                                <span class="pe-3" dir="rtl" style="min-width: 161px;font-weight: 500;"> Tên nhân viên</span>
                                <input name="nameEmployee" required type="text" class="form-control" placeholder="" value='<?php echo $employee['fullname'] ?>'>
                            </div>
                        </div>

                        <div class="col-md-12 pe-4">
                            <div class="input-group mb-3">
                                <span class="pe-3" dir="rtl" style="min-width: 161px;font-weight: 500;"> Địa chỉ</span>
                                <input name="addEmployee" required type="text" class="form-control" placeholder="" value='<?php echo $employee['address'] ?>'>        
                            </div>
                        </div>

                        <div class="col-md-12 pe-4" style="margin-bottom:16px">
                            <span class="pe-3" dir="rtl" style="margin-left:76px;font-weight: 500;">Giới tính</span>
                            <?php
                            if($employee['gender']=='Nam'){
                                echo '<label>';
                                    echo '<input type="radio" name="genderEmployee" value="Nam" checked required> Nam';
                                echo '</label>';
                                echo '<label>';
                                    echo '<input type="radio" name="genderEmployee" class="ms-3" value="Nữ" required> Nữ';
                                echo '</label>';
                            }
                            else{
                                echo '<label>';
                                    echo '<input type="radio" name="genderEmployee" value="Nam" required> Nam';
                                echo '</label>';
                                echo '<label>';
                                    echo '<input type="radio" name="genderEmployee" checked class="ms-3" value="Nữ" required> Nữ';
                                echo '</label>';
                            }

                            ?>
                        </div>

                        <div class="col-md-12 pe-4">
                            <div class="input-group mb-3">
                                <span class="pe-3" dir="rtl" style="min-width: 161px;font-weight: 500;"> Email</span>
                                <input name="emailEmployee" required type="email" class="form-control" placeholder="" value='<?php echo $employee['email'] ?>'>
                                <span class="pe-3" dir="rtl" style="min-width: 70px;font-weight: 500;"> SDT</span>
                                <input name="phoneEmployee" required type="tel" class="form-control" placeholder="" value='<?php echo $employee['phone'] ?>'>
                            </div>
                        </div>


                        <div class="col-md-12 pe-4">
                            <div class="input-group mb-3">
                                <span class="pe-3" dir="rtl" style="min-width: 161px;font-weight: 500;"> Tài khoản</span>
                                <input name="username" readonly type="text" class="form-control" placeholder="" value='<?php echo $employee['username'] ?>'>
                                <span class="pe-3" dir="rtl" style="min-width: 70px;font-weight: 500;">Pass</span>
                                <input name="password" required type="tel" class="form-control" placeholder="" value='<?php echo $employee['password'] ?>'>
                            </div>
                        </div>
                    </div>
                </div>
                <!--  -->

                <div class="col-md-12 py-2 d-flex justify-content-end">
                    <a type="button" href="employees" class="btn btn-secondary px-4">Hủy và quay lại</a>
                    <button class="btn btn-primary px-4 mx-3 bg-success" id="btn-update-employee" type="submit" name="btnUpdateEmployee">Cập nhật thông tin</button>

                </div>
            </form>
            <!--  -->
        </div>
    </div>
</div>
<!--  -->

<!-- Content end-->

<?php
include "partials/footerAdmin.php";
?>