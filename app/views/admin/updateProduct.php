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


<?php
    //Cấu hình Cloudinary để lấy API Upload
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
        $valid_types = ['image/jpeg', 'image/png', 'image/gif','image/jpg'];
        $upload_errors = [];
    
        for ($i = 0; $i < $max_files; $i++) {
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
                // print_r($image_urls);
            }

?>

<!-- Content start-->
<div class="col main-right container-fluid row ">

<!--  -->
<div class="col-md-12 mt-2 mb-3 nav-page">
    <h5 class="text-muted"><a href="">Trang quản trị</a> / <a href="">Quản lý sản phẩm</a> / <b href="">Cập nhật sản phẩm</b></h5>
</div>
<!--  -->
<div class="col-md-12 manage-products shadow">
    <div class="col-md-12">
        <i class="bi bi-pencil-square fs-2 text-primary"></i>
        <span>
            <strong class="fs-4 ms-2">Cập nhật sản phẩm có ID: <?php echo $product['productID'] ?></strong>
            <p class="ms-5 text-danger" style="font-weight: 500;">Vui lòng điền đầy đủ thông tin sản phẩm.</p>
        </span>
        <hr>
        <div class="basic-info col-md-12 ms-5 container-fluid px-0 pb-5 ms-0">
            <h5 class="mb-3"><strong>Hình ảnh</strong></h5>
            <p class="ms-4 mb-4"><span class="text-danger" style="font-weight: 500;">(*)</span>  Tối thiểu 1, tối đa 3 hình ảnh</p>
        </div>
    </div>

        <form action="" method="POST" enctype="multipart/form-data" id ="myForm" class="ms-5">
            <!-- ảnh 1 -->
            <div class="input-group mb-3">
                <?php
                if(isset($product['image1']) && (!isset($image_urls[0]))){
                    echo '<img src="'.$product['image1'].'" width="200" height ="200" class="me-3 mb-3">';
                }
                ?>

                <?php if (!isset($image_urls[0])): ?>
                    <input type="file" name="image0" accept="image/*" class="me-3">
                <?php endif ?>

                <?php if (isset($image_urls[0])): ?>
                    <img src="<?php echo $image_urls[0] ?>" width="200" height ="200" class="me-3">
                <?php endif ?>

            <!-- ảnh 2 -->


                <?php
                    if(isset($product['image2'])&& (!isset($image_urls[1]))){
                        echo '<img src="'.$product['image2'].'" width="200" height ="200" class="me-3 mb-3">';
                    }
                ?>
                    
                <?php if (!isset($image_urls[0])): ?>
                <input type="file" name="image1" accept="image/*" class="me-3">
                <?php endif ?>

                <?php if (isset($image_urls[1])): ?>
                    <img src="<?php echo $image_urls[1] ?>" width="200" height="200" class="me-3">
                <?php endif ?>



                <!-- ảnh 3 -->
                <?php
                    if(isset($product['image3'])&& (!isset($image_urls[2]))){
                        echo '<img src="'.$product['image3'].'" width="200" height ="200" class="me-3 mb-3">';
                    }
                ?>

                <?php if (!isset($image_urls[0])): ?>
                    <input type="file" name="image2" accept="image/*" class="me-3">
                <?php endif ?>

                <?php if (isset($image_urls[2])): ?>
                    <img src="<?php echo $image_urls[2] ?>" width="200" height="200" class="me-3">
                <?php endif ?>
            </div>

            <input type="submit" value="Xem ảnh">
        </form>

    <!--  -->
    <div class="col-md-12 d-flex justify-content-center">
        <div class="col-md-11">
            <hr>
            <form method="POST" action="updateProductProcess.php" enctype="multipart/form-data" autocomplete="off">
                <div class="basic-info col-md-12">
                    <h5><strong>Tình trạng kho hàng</strong></h5>
                    <div class="col-md-12 pe-4">
                        <div class="input-group mb-3">
                            <span class="pe-3" dir="rtl" style="min-width: 161px;">Kho hàng</span>
                            <input name="prodStockUpdate" required type="number" class="form-control" value="<?php echo $product['stock'] ?>" placeholder="">
                        </div>
                    </div>
                </div>

                <hr>

                <div class="basic-info col-md-12 mt-3">
                    <h5><strong>Cập nhật thông tin cơ bản</strong></h5>
                    <div class="input-group mb-3 mt-5">
                        <div class="col-md-12 pe-4">
                            <div class="input-group mb-3">
                                <span class="pe-3" dir="rtl" style="min-width: 161px;"> Tên sản phẩm</span>
                                <input name="prodNameUpdate" type="text" value ="<?php echo $product['productName'] ?>" required class="form-control" placeholder="">
                            </div>
                            <p class="text-danger" id="prodNameUpdateHelp" dir="ltr" style="margin-left: 161px; font-weight: 500; font-size: 15px"></p>
                        </div>
                        <div class="col-md-12 pe-4">
                            <div class="input-group mb-3">
                                <span class="pe-3" dir="rtl" style="min-width: 161px;"> Mô tả sản phẩm</span>
                                <textarea name="prodDetailUpdate" class="form-control" value="<?php echo $product['detail'] ?>" required rows="10" aria-label="With textarea" cols="40" placeholder="<?php echo $product['detail'] ?>"><?php echo $product['detail'] ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 pe-4">
                            <div class="input-group mb-3">
                                <span class="pe-1" dir="rtl" style="min-width: 161px;margin-right:10px"> Danh mục sản phẩm</span>
                                <input readonly name="prodCategoryUpdate" class="form-select" value ="<?php echo $product['name'] ?>" required style="max-width: 500px;">
                                </input>
                            </div>
                        </div>
                        <div class="col-md-12 pe-4">
                            <div class="input-group mb-3">
                                <span class="pe-1" dir="rtl" style="min-width: 161px;margin-right:10px"> Chọn nhà cung cấp</span>
                                <input name="prodSupplierUpdate" class="form-select" value="<?php echo $product['supplierName'] ?>" required style="max-width: 500px;" readonly></input>
                            </div>
                        </div>

                        <div class="col-md-12 pe-4">
                            <div class="input-group mb-3">
                                <span class="pe-3" dir="rtl" style="min-width: 161px;"> Số lượng đã bán</span>
                                <input name="prodSoldUpdate" type="text" value ="<?php echo $product['sold'] ?>" required class="form-control" placeholder="">
                            </div>
                            <p class="text-danger" id="prodNameUpdateHelp" dir="ltr" style="margin-left: 161px; font-weight: 500; font-size: 15px"></p>
                        </div>
                    </div>
                </div>
                <!--  -->
                <hr>
                <div class="basic-info col-md-12">
                    <h5><strong>Thông tin bán hàng</strong></h5>
                    <div class="col-md-12 pe-4 mt-3">
                        <div class="input-group mb-3">
                            <span class="pe-3" dir="rtl" style="min-width: 161px;">Giá </span>
                            <span class="input-group-text">đ</span>
                            <input name="prodPriceUpdate"  value ="<?php echo $product['price'] ?>" required type="number" class="form-control" placeholder="">
                        </div>
                    </div>
                </div>


                <!--  -->
                <!-- <div class="basic-info col-md-12 container-fluid px-0 pb-5 ms-0">
                    <h5 class="mb-3"><strong>Hình ảnh</strong></h5>
                    <div class="col-md-12 d-flex justify-content-center mb-3 text-danger waring-no-image-Update d-none" style="font-weight: 500;">
                        <i class="bi bi-exclamation-circle-fill">Chưa có ảnh nào, yêu cầu sản phẩm có ít nhất 1 hình ảnh!</i>
                    </div>
                    <p class="ms-4 mb-4"><span class="text-danger" style="font-weight: 500;">(*)</span>  Tối thiểu 1, tối đa 3 hình ảnh</p>
                </div> -->
                
                <input type="hidden" value="<?php echo count($image_urls)>=1 ? $image_urls[0] : '' ?>" name="imageUpdate0">
                <input type="hidden" value="<?php echo count($image_urls)>=2 ? $image_urls[1] : '' ?>" name="imageUpdate1">
                <input type="hidden" value="<?php echo count($image_urls)>=3 ? $image_urls[2] : '' ?>" name="imageUpdate2">
                <input type="hidden" value="<?php echo $product['productID'] ?>" name="prodID">
                
                <hr>

                <div class="col-md-12 py-2 d-flex justify-content-end">
                    <a type="button" href="index.php" class="btn btn-secondary px-4">Hủy và quay lại</a>
                    <button class="btn btn-danger px-4 mx-3" id="btn-update-product" type="submit" name="btnUpdateProduct">Cập nhật sản phẩm</button>
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