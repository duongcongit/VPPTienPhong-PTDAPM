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
    <h5 class="text-muted"><a href="">Trang quản trị hệ thống</a> / <a href="">Quản lý nhà cung cấp</a> / <b href="">Thêm nhà cung cấp mới</b></h5>
</div>
<!--  -->
<div class="col-md-12 manage-products shadow">
    <div class="col-md-12">
        <span>
            <strong class="fs-4 ms-2 nav-link text-danger">Thêm nhà cung cấp mới</strong>
        </span>
    </div>
    <!--  -->
    <div class="col-md-12 d-flex justify-content-center">
        <div class="col-md-11">
            <hr>
            <form method="POST" action="addSupplierProcess" enctype="multipart/form-data" autocomplete="off">
                <div class="basic-info col-md-12">
                    <div class="input-group mb-3 mt-5">
                        <div class="col-md-12 pe-4">
                            <div class="input-group mb-3">
                                <span class="pe-3" dir="rtl" style="min-width: 161px;font-weight: 500;"> Tên nhà cung cấp</span>
                                <input name="nameSupplier" required type="text" class="form-control" placeholder="Nhập vào">
                            </div>
                            <p class="text-danger" id="prodNameAddHelp" dir="ltr" style="margin-left: 161px; font-weight: 500; font-size: 15px"></p>
                        </div>
                        <div class="col-md-12 pe-4">
                            <div class="input-group mb-3">
                                <span class="pe-3" dir="rtl" style="min-width: 161px;font-weight: 500;"> Địa chỉ</span>
                                <input name="addSupplier" required type="text" class="form-control" placeholder="Nhập vào">
                            </div>
                        </div>
                        <div class="col-md-12 pe-4">
                            <div class="input-group mb-3">
                                <span class="pe-3" dir="rtl" style="min-width: 161px;font-weight: 500;"> Email</span>
                                <input name="emailSupplier" required type="email" class="form-control" placeholder="Nhập vào">
                                <span class="pe-3" dir="rtl" style="min-width: 70px;font-weight: 500;"> SDT</span>
                                <input name="phoneSupplier" required type="tel" class="form-control" placeholder="Nhập vào">
                            </div>
                            <p class="text-danger" id="prodSKUAddHelp" dir="ltr" style="margin-left: 161px; font-weight: 500; font-size: 15px"></p>
                        </div>
                    </div>
                </div>
                <!--  -->

                <div class="col-md-12 py-2 d-flex justify-content-end">
                    <a type="button" href="suppliers" class="btn btn-secondary px-4">Hủy và quay lại</a>
                    <button class="btn btn-primary px-4 mx-3" id="btn-add-supplier" type="submit" name="btnAddSupplier">Thêm nhà cung cấp</button>
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