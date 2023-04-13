<?php
include _DIR_ROOT . "/app/views/partials/header.php";
?>

<script>
    document.title = "<?php echo "Danh mục" ?>";
</script>

<!-- Main -->
<div class="container-fluid main p-0 mt-0">
    <div class="row" style="max-width: 1200px;margin: auto; min-height: 90vh;">

        <!-- Content -->
        <div class="content ps-3 mt-5">
            <div class="col-md-12 row">
                <div class="col-md-12 d-flex justify-content-between mb-4 text-secondary">
                    <div>
                        <h4>
                            <i class="bi bi-house-fill"></i>
                            <a href="<?php echo SITEURL; ?>" style="text-decoration: none;" class="text-body">
                                Trang chủ
                            </a>
                            /<?php echo $category['name']; ?>
                        </h4>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle" style="border: 1px ridge grey;" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php
                            $sortBy = array_filter(explode('/', $_SERVER['PATH_INFO']));
                            if (count($sortBy) >= 4) {
                                switch ($sortBy[4]) {
                                    case 'product name asc':
                                        echo "Tên A-Z";
                                        break;
                                    case 'product name desc':
                                        echo "Tên Z_A";
                                        break;
                                    case 'price asc':
                                        echo "Giá tăng dần";
                                        break;
                                    case 'price desc':
                                        echo "Giá giảm dần";
                                        break;
                                    default:
                                        echo "Bán chạy nhất";
                                        break;
                                }
                            }
                            else{echo "Bán chạy nhất";}
                            ?>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="<?php echo SITEURL . "category/category/" . strtolower($category['categoryID']) . "/sold desc"; ?>">Bán chạy nhất</a></li>
                            <li><a class="dropdown-item" href="<?php echo SITEURL . "category/category/" . strtolower($category['categoryID']) . "/product name asc"; ?>">Tên A-Z</a></li>
                            <li><a class="dropdown-item" href="<?php echo SITEURL . "category/category/" . strtolower($category['categoryID']) . "/product name desc"; ?>">Tên Z-A</a></li>
                            <li><a class="dropdown-item" href="<?php echo SITEURL . "category/category/" . strtolower($category['categoryID']) . "/price asc"; ?>">Giá tăng dần</a></li>
                            <li><a class="dropdown-item" href="<?php echo SITEURL . "category/category/" . strtolower($category['categoryID']) . "/price desc"; ?>">Giá giảm dần</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-3 d-none d-md-flex row" style="height: fit-content;">
                    <div class="col-md-12"><strong class="fs-5">Danh mục sản phẩm</strong>
                    </div>
                    <div class="col-md-12 category-menu shadow">
                        <ul class="m-auto mb-2 mb-lg-0">
                            <?php
                            foreach ($categories as $ctg) {
                            ?>
                                <li class="">
                                    <a class="" href="<?php echo SITEURL; ?>category/category/<?php echo strtolower($ctg['categoryID']) ?>"><?php echo $ctg['name']; ?></a>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>


                <?php
                if (count($products) > 0) {
                ?>
                    <div class="col-md-8 ms-2 row d-flex justify-content-start">
                        <?php
                        foreach ($products as $product) {
                        ?>
                            <!-- Items -->
                            <div class="pb-3 items-card col-sm-5 col-md-3" style="width: 17rem;">
                                <div class="col-md-12 product-image">
                                    <a href="<?php echo SITEURL . 'product/detail/' . $product['productID']; ?>">
                                        <img src="<?php echo $product['image1']; ?>" class="card-img-top" alt="...">
                                    </a>
                                </div>

                                <hr class="p-0 m-0 mb-4 m-auto d-none d-md-flex" style="width: 50%;">
                                <div class="d-flex justify-content-center">
                                    <a href="product/detail/<?php echo $product['productID']; ?>">
                                        <h6 class="card-title"><?php echo $product['productName']; ?></h6>
                                    </a>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <strong><?php echo $product['price']; ?></strong>
                                </div>
                                <div class="d-flex justify-content-center pt-3">
                                    <?php
                                    if ($product['stock'] > 0) {
                                    ?>
                                        <button class="btn btn-info text-light btn-add-to-cart" style="background-color:  rgb(58, 160, 180);" data-customer_id="<?php echo $_SESSION['customerID'] ?>" data-product_id="<?php echo $product['productID']; ?>">Thêm vào giỏ</button>
                                    <?php } else {
                                    ?>
                                        <button class="btn btn-info text-light btn-out-of-stock bg-secondary" style="border: grey;" disabled>Hết hàng</button>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>

                        <?php
                        }
                        ?>


                    </div>

                <?php
                } else {
                ?>

                    <div class="col-md-8 row d-flex justify-content-center align-items-center" style="height: 50vh;align-items:center;">

                        <i class="bi bi-box-seam fs-1 me-0" style="width: fit-content;"></i>Không có sản phẩm nào

                    </div>
                <?php
                }
                ?>
            </div>

        </div>

    </div>
</div>

<?php
include _DIR_ROOT . "/app/views/partials/footer.php";
?>