<?php
include "../config/constants.php";

include "./partials/loginCheck.php";
include './partials/headerAdmin.php';


// Check
if (isset($_GET['productid']) && isset($_GET['productsku'])) {
    $prodID = $_GET['productid'];
    $prodSKU = $_GET['productsku'];

    $sql = "SELECT products.*,categoryName
    FROM products,categories
    WHERE products.categoryID = categories.id
    AND products.productID='$prodID' AND productSKU = '$prodSKU'";
    $res = $conn->query($sql);
    if ($res->num_rows > 0) {
        $prodInf = $res->fetch_assoc();
    } 
    //
} 

?>

<!-- Content start-->
<div class="col main-right container-fluid row">

<!--  -->
<div class="col-md-12 mt-2 mb-3 nav-page">
    <h5 class="text-muted"><a href="">Kênh người bán</a> / <a href="">Quản lý sản phẩm</a> / <b href="">Thêm sản phẩm</b></h5>
</div>
<!--  -->
<div class="col-md-12 manage-products shadow">
    <div class="col-md-12">
        <i class="bi bi-pencil-fill fs-2 text-primary"></i>
        <span>
            <strong class="fs-4 ms-2">Cập nhật thông tin sản phẩm</strong>
            <p class="ms-5 text-danger" style="font-weight: 500;">! Chú ý: Các trường "*" là bắt buộc.</p>
        </span>
    </div>
    <!--  -->
    <div class="col-md-12 d-flex justify-content-center">
        <div class="col-md-11">
            <hr>
            <form method="POST" action="./process-edit-product.php" enctype="multipart/form-data" autocomplete="off">
                <div class="basic-info col-md-12">
                    <!--  -->
                    <div class="basic-info col-md-12">
                        <h5><strong>Tình trạng kho hàng</strong></h5>
                        <div class="col-md-12 pe-4 my-4">
                            <div class="input-group mb-3">
                                <span class="pe-3" dir="rtl" style="min-width: 161px;">Kho hàng</span>
                                <input name="prodStockEdit" type="text" class="form-control" placeholder="Để trống = 0" value="<?php echo $prodInf['stock'] ?>">
                            </div>
                        </div>
                    </div>
                    <!--  -->
                    <hr>
                    <h5><strong>Thông tin cơ bản</strong></h5>
                    <!-- Sent product ID -->
                    <input type="hidden" name="productID" value="<?php echo $prodInf['productID']; ?>">
                    <!--  -->
                    <div class="input-group mb-3 mt-5">
                        <div class="col-md-12 pe-4">
                            <div class="input-group mb-3">
                                <span class="pe-3" dir="rtl" style="min-width: 161px;"><span class="text-danger" style="font-weight: 500;">*</span> Tên sản phẩm</span>
                                <input name="prodNameEdit" type="text" class="form-control" placeholder="Nhập vào" value="<?php echo $prodInf['productName'] ?>" data-curr_prod_name="<?php echo $prodInf['productName'] ?>">
                            </div>
                            <p class="text-danger" id="prodNameEditHelp" dir="ltr" style="margin-left: 161px; font-weight: 500; font-size: 15px"></p>
                        </div>
                        <div class="col-md-12 pe-4">
                            <div class="input-group mb-3">
                                <span class="pe-3" dir="rtl" style="min-width: 161px;"><span class="text-danger" style="font-weight: 500;">*</span> Mô tả sản phẩm</span>
                                <textarea name="prodDetailEdit" class="form-control" rows="10" aria-label="With textarea" cols="40" placeholder="Mô tả sản phẩm ..."><?php echo $prodInf['detail'] ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 pe-4">
                            <div class="input-group mb-3">
                                <span class="pe-1" dir="rtl" style="min-width: 161px;"><span class="text-danger" style="font-weight: 500;">*</span> Danh mục sản phẩm</span>
                                <select name="prodCategoryEdit" class="form-select" style="max-width: 500px;">
                                    <?php
                                    //Lấy tất cả loại sản phẩm
                                    $sql_get_all_category = "SELECT * FROM categories";
                                    $res_cat = $conn->query($sql_get_all_category);
                                    while ($cat = $res_cat->fetch_assoc() ) {
                                    ?>
                                        <option value="<?php echo $cat['id']; ?>" <?php echo ($prodInf['categoryID'] == "{$cat['id']}" ? "selected" : "") ?>><?php echo $cat['categoryName']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 pe-4">
                            <div class="input-group mb-3">
                                <span class="pe-3" dir="rtl" style="min-width: 161px;"><span class="text-danger" style="font-weight: 500;"></span> Mã SKU</span>
                                <input name="prodSKUEdit" type="text" class="form-control" placeholder="Tùy chọn" value="<?php echo $prodInf['productSKU'] ?>" data-curr_prod_sku="<?php echo $prodInf['productSKU'] ?>">
                            </div>
                            <p class="text-danger" id="prodSKUEditHelp" dir="ltr" style="margin-left: 161px; font-weight: 500; font-size: 15px"></p>
                        </div>
                    </div>
                </div>
                <!--  -->
                <hr>
                <div class="basic-info col-md-12">
                    <h5><strong>Thông tin bán hàng</strong></h5>
                    <div class="col-md-12 pe-4 mt-5 mb-5">
                        <div class="input-group mb-3">
                            <span class="pe-3" dir="rtl" style="min-width: 161px;">Giá </span>
                            <span class="input-group-text">đ</span>
                            <input name="prodPriceEdit" type="text" class="form-control" placeholder="Để trống = 0" value="<?php echo $prodInf['price'] ?>">
                        </div>
                    </div>
                </div>
                <!--  -->
                <hr>
                <div class="basic-info col-md-12 container-fluid px-0 pb-5 ms-0">
                    <h5 class="mb-5"><strong>Quản lý hình ảnh</strong></h5>
                    <div class="col-md-12 d-flex justify-content-center mb-3 text-danger waring-no-image-edit d-none" style="font-weight: 500;">
                        <i class="bi bi-exclamation-circle-fill">Chưa có ảnh nào, yêu cầu sản phẩm có ít nhất 1 hình ảnh!</i>
                    </div>
                    <p class="ms-4 mb-4"><span class="text-danger" style="font-weight: 500;">(*)</span> Tối thiểu 1, tối đa 3 hình ảnh</p>
                    <div class="row ms-5">
                        <!-- Image 1 -->
                        <?php
                        //Lấy ảnh của sản phẩm
                        $sql_get_img1 = "SELECT * FROM product_image WHERE productID='{$prodInf['productID']}' AND image LIKE '1%';";
                        $get_img1 = $conn->query($sql_get_img1);
                        ?>
                        <div class="card p-0 mb-3 me-3 d-flex justify-content-center" style="width: 200px;height: 200px;">
                            <input type="file" name="prodImg1Edit" id="photo-1-input" onchange="loadPhoto1(event)">
                            <label for="photo-1-input" type="button">
                                <img id="photo-1-preview" src="
                                <?php
                                if ($get_img1->num_rows == 1) {
                                    $img1 = $get_img1->fetch_assoc()['image'];
                                    echo "../assets/img/products/" . $img1;
                                } else {
                                    echo "../assets/img/no-image.png";
                                }
                                ?>
                                 " alt="" style="max-width: 100%;">
                            </label>
                            <!--  -->
                            <div class="d-flex justify-content-between edit-pt-1" style="position: absolute;margin-left: 140px; top: 0; border: solid 1px rgb(72, 120, 224); border-radius: 5px; background-color: rgba(188, 199, 219, 0.8);">
                                <label for="photo-1-input" type="button">
                                    <i class="bi bi-pencil-fill text-primary fs-5 ms-2"></i>
                                </label>
                                <i class="bi bi-trash-fill text-danger fs-5 ms-2" id="del-photo-1-edit" type="button"></i>
                                <input type="hidden" name="isphoto1editempty" value="<?php echo ($get_img1->num_rows == 1 ? $img1 : "TRUE") ?>">
                            </div>
                            <!--  -->
                        </div>
                        <!--  -->
                        <script>
                            var loadPhoto1 = function(event) {
                                // $(".edit-pt-1").removeClass("d-none");
                                // $("[name='isphoto1editempty']").val("FALSE");
                                document.getElementById("photo-1-preview").src = URL.createObjectURL(event.target.files[0]);
                                output.onload = function() {
                                    URL.revokeObjectURL(output.src);
                                };
                            };
                        </script>
                        <!--  -->

                        <!-- Image 2 -->
                        <?php
                        $sql_get_img2 = "SELECT * FROM product_image WHERE productID='{$prodInf['productID']}' AND image LIKE '2%';";
                        $get_img2 = $conn->query($sql_get_img2);
                        ?>
                        <div class="card px-0 mb-3 me-3 d-flex justify-content-center align-items-center" style="width: 200px;height: 200px;background-size: contain;">
                            <input type="file" name="prodImg2Edit" id="photo-2-input" onchange="loadPhoto2(event)">
                            <label for="photo-2-input" type="button">
                                <img id="photo-2-preview" src="
                                <?php
                                if ($get_img2->num_rows == 1) {
                                    $img2 = $get_img2->fetch_assoc()['image'];
                                    echo "../assets/img/products/" . $img2;
                                } else {
                                    echo "../assets/img/no-image.png";
                                }
                                ?>
                                " alt="" style="max-width: 100%;">
                            </label>
                            <!--  -->
                            <div class="d-flex justify-content-between edit-pt-2" style="position: absolute;margin-left: 140px; top: 0; border: solid 1px rgb(72, 120, 224); border-radius: 5px; background-color: rgba(188, 199, 219, 0.8);">
                                <label for="photo-2-input" type="button">
                                    <i class="bi bi-pencil-fill text-primary fs-5 ms-2"></i>
                                </label>
                                <i class="bi bi-trash-fill text-danger fs-5 ms-2" id="del-photo-2-edit" type="button"></i>
                                <input type="hidden" name="isphoto2editempty" value="<?php echo ($get_img2->num_rows == 1 ? $img2 : "TRUE") ?>">
                            </div>
                            <!--  -->
                        </div>
                        <!--  -->
                        <script>
                            var loadPhoto2 = function(event) {
                                // $(".edit-pt-2").removeClass("d-none");
                                document.getElementById("photo-2-preview").src = URL.createObjectURL(event.target.files[0]);
                                output.onload = function() {
                                    URL.revokeObjectURL(output.src);
                                };
                            };
                        </script>
                        <!--  -->

                        <!-- Image 2 -->
                        <?php
                        $sql_get_img3 = "SELECT * FROM product_image WHERE productID='{$prodInf['productID']}' AND image LIKE '3%';";
                        $get_img3 = $conn->query($sql_get_img3);
                        ?>
                        <div class="card px-0 mb-3 me-3 d-flex justify-content-center align-items-center" style="width: 200px;height: 200px;background-size: contain;">
                            <input type="file" name="prodImg3Edit" id="photo-3-input" onchange="loadPhoto3(event)">
                            <label for="photo-3-input" type="button">
                                <img id="photo-3-preview" src="
                                <?php
                                if ($get_img3->num_rows == 1) {
                                    $img3 = $get_img3->fetch_assoc()['image'];
                                    echo "../assets/img/products/" . $img3;
                                } else {
                                    echo "../assets/img/no-image.png";
                                }
                                ?>
                                " alt="" style="max-width: 100%;">
                            </label>
                            <!--  -->
                            <div class="d-flex justify-content-between edit-pt-3" style="position: absolute;margin-left: 140px; top: 0; border: solid 1px rgb(72, 120, 224); border-radius: 5px; background-color: rgba(188, 199, 219, 0.8);">
                                <label for="photo-3-input" type="button">
                                    <i class="bi bi-pencil-fill text-primary fs-5 ms-2"></i>
                                </label>
                                <i class="bi bi-trash-fill text-danger fs-5 ms-2" id="del-photo-3-edit" type="button"></i>
                                <input type="hidden" name="isphoto3editempty" value="<?php echo ($get_img3->num_rows == 1 ? $img3 : "TRUE") ?>">
                            </div>
                            <!--  -->
                        </div>
                        <!--  -->
                        <script>
                            var loadPhoto3 = function(event) {
                                // $(".edit-pt-3").removeClass("d-none");
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
                    <a type="button" href="./index.php" class="btn btn-secondary px-4">Hủy cập nhật</a>
                    <button class="btn btn-primary px-4 mx-3" id="btn-edit-product" type="submit" name="btnEditProduct">Cập nhật</button>
                </div>
            </form>
            <!--  -->
        </div>
    </div>
</div>
<!--  -->

<!-- Content end-->

<?php
include "./partials/footerAdmin.php";
?>