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
    <h5 class="text-muted"><a href="">Trang quản trị hệ thống</a> / <a href="">Quản lý nhân viên</a> / <b href="">Thêm nhân viên</b></h5>
</div>
<!--  -->
<div class="col-md-12 manage-products shadow">
    <div class="col-md-12">
        <span>
            <strong class="fs-4 ms-2 nav-link text-danger">Thêm nhân viên mới</strong>
        </span>
    </div>
    <!--  -->
    <div class="col-md-12 d-flex justify-content-center">
        <div class="col-md-11">
            <hr>
            <form method="POST" action="addEmployeeProcess" enctype="multipart/form-data" autocomplete="off">
                <div class="basic-info col-md-12">
                    <div class="input-group mb-3 mt-5">
                        <div class="col-md-12 pe-4">
                            <div class="input-group mb-3">
                                <span class="pe-3" dir="rtl" style="min-width: 161px;font-weight: 500;"> Tên nhân viên</span>
                                <input name="nameEmployee" required type="text" class="form-control" placeholder="Nhập vào">
                            </div>
                        </div>

                        <div class="col-md-12 pe-4">
                            <div class="input-group mb-3">
                                <span class="pe-3" dir="rtl" style="min-width: 161px;font-weight: 500;"> Địa chỉ</span>
                                <input name="addEmployee" required type="text" class="form-control" placeholder="Nhập vào">        
                            </div>
                        </div>

                        <div class="col-md-12 pe-4" style="margin-bottom:16px">
                            <span class="pe-3" dir="rtl" style="margin-left:76px;font-weight: 500;">Giới tính</span>
                            <label>
                                <input type="radio" name="genderEmployee" value="Nam" required> Nam
                            </label>
                            <label>
                                <input type="radio" name="genderEmployee" value="Nữ" required> Nữ
                            </label>
                        </div>

                        <div class="col-md-12 pe-4">
                            <div class="input-group mb-3">
                                <span class="pe-3" dir="rtl" style="min-width: 161px;font-weight: 500;"> Email</span>
                                <input name="emailEmployee" required type="email" class="form-control" placeholder="Nhập vào">
                                <span class="pe-3" dir="rtl" style="min-width: 70px;font-weight: 500;"> SDT</span>
                                <input name="phoneEmployee" required type="tel" class="form-control" placeholder="Nhập vào">
                            </div>
                        </div>


                        <div class="col-md-12 pe-4">
                            <div class="input-group mb-3">
                                <span class="pe-3" dir="rtl" style="min-width: 161px;font-weight: 500;"> Tài khoản</span>
                                <input name="username" id="username" required type="text" class="form-control" placeholder="Nhập vào">
                                <span class="pe-3" dir="rtl" style="min-width: 70px;font-weight: 500;">Pass</span>
                                <input name="password" required type="tel" class="form-control" placeholder="Nhập vào">
                            </div>
                            <span class="username-error" style="color:red;display:none"></span>
                        </div>
                    </div>
                </div>
                <!--  -->

                <div class="col-md-12 py-2 d-flex justify-content-end">
                    <a type="button" href="employees" class="btn btn-secondary px-4">Hủy và quay lại</a>
                    <button class="btn btn-primary px-4 mx-3" id="btn-add-Employee" type="submit" name="btnAddEmployee">Thêm nhân viên</button>
                </div>
            </form>
            <!--  -->
        </div>
    </div>
</div>
<!--  -->

<!-- Content end-->

<script>
$(document).ready(function() {
    $('#username').on('blur', function() {
        var username = $(this).val();
        $.ajax({
            url: 'checkEmployeeUserName',
            type: 'POST',
            data: { username: username },
            dataType: 'json',
            success: function(response) {
                if (response.error == 1) {
                    $('.username-error').text('Tài khoản đã tồn tại. Vui lòng chọn tài khoản khác.').show();
                    $('#btn-add-Employee').prop('disabled', true);
                } else {
                    $('.username-error').hide();
                    $('#btn-add-Employee').prop('disabled', false);
                }
            }
        });
    });
});
</script>

<?php
include "partials/footerAdmin.php";
?>