<?php
    if (!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    if (!isset($_SESSION['adminID'])) {
        header("location: ./login.php");
    }
    include "partials/headerAdmin.php";
    include "partials/loginCheck.php";
?>

<!-- Content start-->
<div class="col main-right container-fluid row ">

<!--  -->
<div class="col-md-12 mt-2 mb-3 nav-page">
    <h5 class="text-muted"><a href="">Trang quản trị</a> / <a href="">Quản lý sản phẩm</a> / <b href="">Thêm sản phẩm</b></h5>
</div>
<!--  -->
<div class="col-md-12 manage-products shadow">
    <div class="col-md-12">
        <i class="bi bi-plus-circle-fill fs-2 text-danger"></i>
        <span>
            <strong class="fs-4 ms-2">Thêm 1 sản phẩm mới</strong>
            <p class="ms-5 mb-0">Vui lòng điền đầy đủ thông tin sản phẩm.</p>
            <p class="ms-5 text-danger" style="font-weight: 500;">! Chú ý: Các trường "*" là bắt buộc.</p>
        </span>
    </div>
    <!--  -->
    <div class="col-md-12 d-flex justify-content-center">
        <div class="col-md-11">
            <hr>
            <form method="POST" action="./process-add-product.php" enctype="multipart/form-data" autocomplete="off">
                <div class="basic-info col-md-12">
                    <h5><strong>Thông tin cơ bản</strong></h5>
                    <div class="input-group mb-3 mt-5">
                        <div class="col-md-12 pe-4">
                            <div class="input-group mb-3">
                                <span class="pe-3" dir="rtl" style="min-width: 161px;"><span class="text-danger" style="font-weight: 500;">*</span> Tên sản phẩm</span>
                                <input name="prodNameAdd" type="text" class="form-control" placeholder="Nhập vào">
                            </div>
                            <p class="text-danger" id="prodNameAddHelp" dir="ltr" style="margin-left: 161px; font-weight: 500; font-size: 15px"></p>
                        </div>
                        <div class="col-md-12 pe-4">
                            <div class="input-group mb-3">
                                <span class="pe-3" dir="rtl" style="min-width: 161px;"><span class="text-danger" style="font-weight: 500;">*</span> Mô tả sản phẩm</span>
                                <textarea name="prodDetailAdd" class="form-control" rows="10" aria-label="With textarea" cols="40" placeholder="Mô tả sản phẩm ..."></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 pe-4">
                            <div class="input-group mb-3">
                                <span class="pe-1" dir="rtl" style="min-width: 161px;"><span class="text-danger" style="font-weight: 500;">*</span> Danh mục sản phẩm</span>
                                <select name="prodCategoryAdd" class="form-select" style="max-width: 500px;">
                                <option value="0">Chọn danh mục sản phẩm</option>
                                <?php
                                foreach($categories as $category)
                                {
                                    echo '<option value="'. $category['id']. '">'. $category['categoryName'] . '</option>';
                                }          
                                ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 pe-4">
                            <div class="input-group mb-3">
                                <span class="pe-3" dir="rtl" style="min-width: 161px;"><span class="text-danger" style="font-weight: 500;"></span> Mã SKU</span>
                                <input name="prodSKUAdd" type="text" class="form-control" placeholder="Tùy chọn">
                            </div>
                            <p class="text-danger" id="prodSKUAddHelp" dir="ltr" style="margin-left: 161px; font-weight: 500; font-size: 15px"></p>
                        </div>
                    </div>
                </div>
                <!--  -->
                <hr>
                <div class="basic-info col-md-12">
                    <h5><strong>Thông tin bán hàng</strong></h5>
                    <div class="col-md-12 pe-4 mt-5">
                        <div class="input-group mb-3">
                            <span class="pe-3" dir="rtl" style="min-width: 161px;">Giá </span>
                            <span class="input-group-text">đ</span>
                            <input name="prodPriceAdd" type="text" class="form-control" placeholder="Để trống = 0">
                        </div>
                    </div>
                    <div class="col-md-12 pe-4">
                        <div class="input-group mb-3">
                            <span class="pe-3" dir="rtl" style="min-width: 161px;">Kho hàng</span>
                            <input name="prodStockAdd" type="text" class="form-control" placeholder="Để trống = 0">
                        </div>
                    </div>
                </div>
                <!--  -->
                <hr>
                <div class="basic-info col-md-12 container-fluid px-0 pb-5 ms-0">
                    <h5 class="mb-3"><strong>Hình ảnh</strong></h5>
                    <div class="col-md-12 d-flex justify-content-center mb-3 text-danger waring-no-image-add d-none" style="font-weight: 500;">
                    <i class="bi bi-exclamation-circle-fill">Chưa có ảnh nào, yêu cầu sản phẩm có ít nhất 1 hình ảnh!</i>
                    </div>
                    <p class="ms-4 mb-4"><span class="text-danger" style="font-weight: 500;">(*)</span>  Tối thiểu 1, tối đa 3 hình ảnh</p>
                    <div class="row ms-5">
                        <div class="card p-0 mb-3 me-3 d-flex justify-content-center" style="width: 200px;height: 200px;">
                            <input type="file" name="prodImg1Add" id="photo-1-input" onchange="loadPhoto1(event)">
                            <label for="photo-1-input" type="button">
                                <img id="photo-1-preview" src="../assets/img/no-image.png" alt="" style="max-width: 100%;">
                            </label>
                            <!--  -->
                            <div class="d-flex justify-content-between edit-pt-1 d-none" style="position: absolute;margin-left: 140px; top: 0; border: solid 1px rgb(72, 120, 224); border-radius: 5px; background-color: rgba(188, 199, 219, 0.8);">
                                <label for="photo-1-input" type="button">
                                    <i class="bi bi-pencil-fill text-primary fs-5 ms-2"></i>
                                </label>
                                <i class="bi bi-trash-fill text-danger fs-5 ms-2" id="del-photo-1" type="button"></i>
                            </div>
                            <!--  -->
                        </div>
                        <!--  -->
                        <script>
                            var loadPhoto1 = function(event) {
                                $(".edit-pt-1").removeClass("d-none");
                                document.getElementById("photo-1-preview").src = URL.createObjectURL(event.target.files[0]);
                                output.onload = function() {
                                    URL.revokeObjectURL(output.src);
                                };
                            };
                        </script>
                        <!--  -->

                        <!-- Photo 2 -->
                        <div class="card px-0 mb-3 me-3 d-flex justify-content-center align-items-center" style="width: 200px;height: 200px;background-size: contain;">
                            <input type="file" name="prodImg2Add" id="photo-2-input" onchange="loadPhoto2(event)">
                            <label for="photo-2-input" type="button">
                                <img id="photo-2-preview" src="../assets/img/no-image.png" alt="" style="max-width: 100%;">
                            </label>
                            <!--  -->
                            <div class="d-flex justify-content-between edit-pt-2 d-none" style="position: absolute;margin-left: 140px; top: 0; border: solid 1px rgb(72, 120, 224); border-radius: 5px; background-color: rgba(188, 199, 219, 0.8);">
                                <label for="photo-2-input" type="button">
                                    <i class="bi bi-pencil-fill text-primary fs-5 ms-2"></i>
                                </label>
                                <i class="bi bi-trash-fill text-danger fs-5 ms-2" id="del-photo-2" type="button"></i>
                            </div>
                            <!--  -->
                        </div>
                        <!--  -->
                        <script>
                            var loadPhoto2 = function(event) {
                                $(".edit-pt-2").removeClass("d-none");
                                document.getElementById("photo-2-preview").src = URL.createObjectURL(event.target.files[0]);
                                output.onload = function() {
                                    URL.revokeObjectURL(output.src);
                                };
                            };
                        </script>
                        <!--  -->

                        <!-- Photo 3 -->
                        <div class="card px-0 mb-3 me-3 d-flex justify-content-center align-items-center" style="width: 200px;height: 200px;background-size: contain;">
                            <input type="file" name="prodImg3Add" id="photo-3-input" onchange="loadPhoto3(event)">
                            <label for="photo-3-input" type="button">
                                <img id="photo-3-preview" src="../assets/img/no-image.png" alt="" style="max-width: 100%;">
                            </label>
                            <!--  -->
                            <div class="d-flex justify-content-between edit-pt-3 d-none" style="position: absolute;margin-left: 140px; top: 0; border: solid 1px rgb(72, 120, 224); border-radius: 5px; background-color: rgba(188, 199, 219, 0.8);">
                                <label for="photo-3-input" type="button">
                                    <i class="bi bi-pencil-fill text-primary fs-5 ms-2"></i>
                                </label>
                                <i class="bi bi-trash-fill text-danger fs-5 ms-2" id="del-photo-3" type="button"></i>
                            </div>
                            <!--  -->
                        </div>
                        <!--  -->
                        <script>
                            var loadPhoto3 = function(event) {
                                $(".edit-pt-3").removeClass("d-none");
                                document.getElementById("photo-3-preview").src = URL.createObjectURL(event.target.files[0]);
                                output.onload = function() {
                                    URL.revokeObjectURL(output.src);
                                };
                            };
                        </script>
                        <!--  -->
                    </div>
                </div>

                <hr>

                <div class="col-md-12 py-2 d-flex justify-content-end">
                    <a type="button" href="index.php" class="btn btn-secondary px-4">Hủy và quay lại</a>
                    <button class="btn btn-primary px-4 mx-3" id="btn-add-product" type="submit" name="btnAddProduct">Thêm sản phẩm</button>
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