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
            <p class="ms-5 text-danger" style="font-weight: 500;">Vui lòng điền đầy đủ thông tin sản phẩm.</p>
        </span>
    </div>

    <?php
    require 'cloudinary/vendor/autoload.php';
    use Cloudinary\Configuration\Configuration;
    use Cloudinary\Api\Upload\UploadApi;
    
    Configuration::instance([
        'cloud' => [
            'cloud_name' => 'dhnr7g6h9', 
            'api_key' => '495527574489912', 
            'api_secret' => 'EbBF4Mwxe6RTiMbx6i0zGvFaADM'],
        'url' => [
            'secure' => true]]);
    
    $max_files = 3;
    $image_urls = [];
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $valid_types = ['image/jpeg', 'image/png', 'image/gif'];
        $upload_errors = [];
    
        for ($i = 1; $i <= $max_files; $i++) {
            if (isset($_FILES['image'.$i])) {
                $file_tmp = $_FILES['image'.$i]['tmp_name'];
                $file_name = basename($_FILES['image'.$i]['name']);
                $file_type = $_FILES['image'.$i]['type'];
                $file_size = $_FILES['image'.$i]['size'];
    
                // Validate file type and size
                if (!in_array($file_type, $valid_types)) {
                    $upload_errors[] = "Invalid file type for image $i.";
                } else {
                    // Sanitize file name
                    $file_name = preg_replace('/[^a-zA-Z0-9_.-]/', '', $file_name);
    
                    // Upload image to Cloudinary
                    $upload_result = (new UploadApi())->upload($file_tmp, [
                        'folder' => 'uploads'
                    ]);
    
                    if (!$upload_result || isset($upload_result['error'])) {
                        // handle error here
                        $upload_errors[] = "Failed to upload image $i.";
                    } else {
                        // Get the image URL from the upload result
                        $image_urls[] = $upload_result['secure_url'];
                    }
                }
            }
        }
        var_dump($image_urls[1]);
    }

?>


        <form action="" method="POST" enctype="multipart/form-data" id ="myForm">
            <!-- ảnh 1 -->
            <div class="input-group mb-3">
                <input type="file" name="image1" accept="image/*">
                <input type="hidden" value="<?php echo isset($image_urls[1]) ? $image_urls[1] : '' ?>" name="imageInsert1">
                <?php if (isset($image_urls[1])): ?>
                    <img src="<?php echo $image_urls[1] ?>" width="200">
                <?php endif ?>
            </div>

            <!-- ảnh 2 -->
            <div class="input-group mb-3">
                <input type="file" name="image2" accept="image/*">
                <input type="hidden" value="<?php echo isset($image_urls[2]) ? $image_urls[2] : '' ?>" name="imageInsert2">
                <?php if (isset($image_urls[2])): ?>
                    <img src="<?php echo $image_urls[2] ?>" width="200">
                <?php endif ?>
            </div>

            <!-- ảnh 3 -->
            <div class="input-group mb-3">
                <input type="file" name="image3" accept="image/*">
                <input type="hidden" value="<?php echo isset($image_urls[3]) ? $image_urls[3] : '' ?>" name="imageInsert3">
                <?php if (isset($image_urls[3])): ?>
                    <img src="<?php echo $image_urls[3] ?>" width="200">
                <?php endif ?>
            </div>

            <input type="submit" value="Upload">
        </form>

    <script>
        var form = document.getElementById("myForm");
        function handleForm(event) { event.preventDefault(); } 
        form.addEventListener('submit', handleForm);
    </script>
    <!--  -->
    <div class="col-md-12 d-flex justify-content-center">
        <div class="col-md-11">
            <hr>
            <form method="POST" action="addProductProcess.php" enctype="multipart/form-data" autocomplete="off">
                <div class="basic-info col-md-12">
                    <h5><strong>Thông tin cơ bản</strong></h5>
                    <div class="input-group mb-3 mt-5">
                        <div class="col-md-12 pe-4">
                            <div class="input-group mb-3">
                                <span class="pe-3" dir="rtl" style="min-width: 161px;"> Tên sản phẩm</span>
                                <input name="prodNameAdd" type="text" required class="form-control" placeholder="Nhập vào">
                            </div>
                            <p class="text-danger" id="prodNameAddHelp" dir="ltr" style="margin-left: 161px; font-weight: 500; font-size: 15px"></p>
                        </div>
                        <div class="col-md-12 pe-4">
                            <div class="input-group mb-3">
                                <span class="pe-3" dir="rtl" style="min-width: 161px;"> Mô tả sản phẩm</span>
                                <textarea name="prodDetailAdd" class="form-control" required rows="10" aria-label="With textarea" cols="40" placeholder="Mô tả sản phẩm ..."></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 pe-4">
                            <div class="input-group mb-3">
                                <span class="pe-1" dir="rtl" style="min-width: 161px;margin-right:10px"> Danh mục sản phẩm</span>
                                <select name="prodCategoryAdd" class="form-select" required style="max-width: 500px;">
                                <option value="0">Chọn danh mục sản phẩm</option>
                                <?php
                                foreach($categories as $category)
                                {
                                    echo '<option value="'. $category['categoryID']. '">'. $category['name'] . '</option>';
                                }          
                                ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 pe-4">
                            <div class="input-group mb-3">
                                <span class="pe-1" dir="rtl" style="min-width: 161px;margin-right:10px"> Chọn nhà cung cấp</span>
                                <select name="prodSupplierAdd" class="form-select" required style="max-width: 500px;">
                                <option value="0">Chọn nhà cung cấp</option>
                                <?php
                                foreach($suppliers as $supplier)
                                {
                                    echo '<option value="'. $supplier['supplierID']. '">'. $supplier['supplierName'] . '</option>';
                                }          
                                ?>
                                </select>
                            </div>
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
                            <input name="prodPriceAdd"  required type="number" class="form-control" placeholder="Nhập giá sản phẩm">
                        </div>
                    </div>
                    <div class="col-md-12 pe-4">
                        <div class="input-group mb-3">
                            <span class="pe-3" dir="rtl" style="min-width: 161px;">Kho hàng</span>
                            <input name="prodStockAdd" required type="number" class="form-control" placeholder="Nhập số lượng kho hàng">
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