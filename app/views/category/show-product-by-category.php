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
            <div class="col-md-12">
                <div class="col-md-12 d-flex justify-content-start mb-4 text-secondary">
                    <h4>
                        <i class="bi bi-house-fill"></i>
                        <a href="<?php echo SITEURL; ?>" style="text-decoration: none;" class="text-body">
                            Trang chủ
                        </a>
                    </h4>
                    <h4>/<?php echo $category['name']; ?></h4>
                </div>
                <div class="col-md-12 row d-flex justify-content-start">

                

                    <?php
                    if(count($products) > 0){
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
                                <button class="btn btn-info text-light btn-add-to-cart" style="background-color:  rgb(58, 160, 180);" data-customer_id="<?php echo $_SESSION['customerID'] ?>" data-product_id="<?php echo $product['productID']; ?>">Thêm vào giỏ</button>
                            </div>
                        </div>

                    <?php
                    }}
                    ?>


                </div>
            </div>

        </div>

    </div>
</div>

<?php
include _DIR_ROOT . "/app/views/partials/footer.php";
?>