<?php
include _DIR_ROOT . "/app/views/partials/header.php";
?>

<style>
    body {
        background-color: rgb(240, 240, 240);
    }
</style>

<script>
    document.title = "Giỏ hàng"
</script>

<div class="main container-fluid cart-main">
    <div class="row" id="cart-view">
        <div class="col-md-12 mt-4 fs-1">
            <p class="bi bi-cart3 text-muted">Giỏ hàng</p>
        </div>

        <!-- SHOW PRODUCTS -->

        <div class="col-md-12 col-lg-9 mb-5">
            <div class="product-cart-attr mb-4 col-md-12 bg-light d-flex align-items-center px-3 py-2">
                <div style="width: 40%;"><input id="btn-check-all-cart" class="me-1 form-check-input" type="checkbox" style="cursor: pointer;">Tất cả (0 sản phẩm)</div>
                <div style="width: 20%;">Giá</div>
                <div style="width: 20%;">Số lượng</div>
                <div style="width: 20%;">Thành tiền</div>
                <i class="bi bi-trash text-muted fs-4 btn-clear-cart" type="button"></i>
            </div>

            <?php
            foreach ($products as $product) {
            ?>
                <!-- Product -->
                <div class="cart-product-info bg-light mb-0 mt-3 col-md-12 d-flex d-flex align-items-center px-3 pb-2 pt-4">
                    <div style="width: 40%;" class="mb-4 d-flex align-items-center">
                        <input class="btn-check-product me-1 form-check-input" type="checkbox" style="cursor: pointer;" data-prodid="<?php echo $product['productID']; ?>" value=" <?php echo $product['price'] * $product['quantity']; ?>">
                        <img src="<?php echo $product['image1']; ?>" alt="" class="product-avatar-list" style="width: 70px;">
                        <span class="product-name ms-2 pe-3" style="word-wrap: break-word; max-width: 70%;"><?php echo $product['productName']; ?></span>
                    </div>
                    <div class="mb-4" style="width: 20%;">
                        <p class="ms-1 mt-3"><?php echo number_format($product['price'], 0, '.', '.'); ?>đ</p>
                    </div>
                    <div style="width: 20%;">
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link bi bi-dash-lg btn-decrease-cart" type="button" data-prodid="<?php echo $product['productID']; ?>"></a>
                            </li>
                            <li class="page-item">
                                <input type="text" class="page-link px-2 text-dark input-quantity-cart" autocomplete="off" data-prodid="<?php echo $product['productID']; ?>" data-prod_price="<?php echo $product['price']; ?>" data-prod_stock="<?php echo $product['stock']; ?>" value="<?php echo $product['quantity']; ?>" style="width: 40px;">
                            </li>
                            <li class="page-item">
                                <a class="page-link bi-plus-lg btn-increase-cart" type="button" data-prodid="<?php echo $product['productID']; ?>"></a>
                            </li>
                        </ul>
                    </div>
                    <div style="width: 20%;" class="text-danger mb-4 amount" data-prodid="<?php echo $product['productID']; ?>" data-amount="
                    <?php echo $product['price'] * $product['quantity']; ?>">
                        <?php echo number_format($product['price'] * $product['quantity'], 0, '.', '.'); ?>
                        <u>đ</u>
                    </div>
                    <div class="mb-4"><i type="button" class="bi bi-trash text-muted fs-5 btn-remove-cart" data-prodid=""></i></div>
                </div>
                <!-- Product -->
            <?php
            }
            ?>


        </div>


        <!-- ACTIONS -->
        <div class="col-md-12 col-lg-3 cart-actions">
            <div class="col-md-12 bg-light px-3">
                <div class="col-md-12 d-flex justify-content-between pt-2">
                    <p class="text-muted">Giao tới</p>
                    <a href="#" class="text-decoration-none">Thay đổi</a>
                </div>
                <div class="col-md-12">
                    <strong></strong>
                    <p class="text-muted mt-1 pb-4"></p>
                </div>
            </div>

            <div class="col-md-12 bg-light px-3 mb-3">
                <div class="col-md-12 d-flex justify-content-between pt-2">
                    <p class="">Khuyến mãi</p>
                    <p class="text-muted">Có thể chọn(0) <i type="button" class="bi bi-info-circle"></i></p>
                </div>
                <div class="col-md-12 d-flex justify-content-center pb-4">
                    <h3 class="text-muted">Không áp dụng</h3>
                </div>
            </div>

            <div class="col-md-12 bg-light px-3 mb-3">
                <div class="col-md-12 d-flex justify-content-between pt-2">
                    <p>Đã chọn: </p>
                    <p class="number-product-checked">0 (Sản phẩm)</p>
                </div>
                <hr>
                <div class="col-md-12 d-flex justify-content-between pt-2">
                    <h4>Tạm tính: </h4>
                    <div>
                        <h4 class="text-danger d-flex justify-content-end total-price">0<u class="ms-1">đ</u></h4>
                        <p class="fs-6">(Đã bao gồm VAT nếu có)</p>
                    </div>
                </div>
            </div>

            <p id="order-help" class="col-md-12 text-danger d-flex justify-content-center d-none" style="font-weight: 500;">(!) Chưa chọn sản phẩm nào.</p>
            <a href="#" id="btn-order" class="btn btn-danger col-md-12 py-2 mb-3">
                <h4 class="mt-1">Đặt hàng</h4>
            </a>
        </div>

    </div>
</div>


<script>
    const SITEURL = "<?php echo SITEURL; ?>";
    // FUNCTION
    // Format giá tiền
    function format_price(price) {
        var value = price.toString();
        var price_formatted = "";
        var d = 0;
        for (let i = value.length - 1; i >= 0; i--) {
            price_formatted = price_formatted + value[i];
            d++;
            if (d % 3 == 0 && d != value.length) {
                price_formatted = price_formatted + ".";
            }
        }
        //
        price_formatted = price_formatted.split("").reverse().join("");
        return price_formatted;
    }

    // Cập nhật số lượng
    function updateQuantity(productID, quantity) {

        $.ajax({
            url: SITEURL + "customer/updateQuantityInCart",
            type: "POST",
            data: {
                productID: productID,
                quantity: quantity
            },
            success: function(data) {
                console.log("Cập nhật giỏ hàng thành công");
            }
        })
    }

    // Cập nhật thành tiền
    function update_amount(productID, price, quantity) {
        var amount = price * quantity;
        $(".amount[data-prodid='" + productID + "']").html(
            format_price(amount) + '<u class="ms-1">đ</u>'
        );
        //
        $(".btn-check-product[data-prodid='" + productID + "']").val(
            parseInt(amount)
        );

    }

    // Cập nhật tổng tiền của các sản phẩm đã chọn
    function update_total_price() {
        var num_inp = $(".btn-check-product").length;
        var amount = 0;
        var num_prod = 0;
        for (let i = 0; i < num_inp; i++) {
            var inp = $(".btn-check-product:eq(" + i + ")");
            if (inp.is(":checked")) {
                num_prod++;
                amount = amount + parseInt(inp.val());
            }
        }
        //
        if(num_prod > 0){
            $("#order-help").addClass("d-none");
        }
        //
        $(".number-product-checked").text(num_prod + " (Sản phẩm)");
        $(".total-price").html(format_price(amount) + '<u class="ms-1">đ</u>');
    }

    // Xử lý sự kiện nhấn nút chọn tất cả sản phẩm
    $(document).on("change", "#btn-check-all-cart", function() {
        if (this.checked) {
            $(".btn-check-product").prop("checked", true);
        } else {
            $(".btn-check-product").prop("checked", false);
        }
        //
        update_total_price();
    });

    // Xử lý sự kiện nhấn nút chọn một sản phẩm
    $(document).on("change", ".btn-check-product", function() {

        var num_products_checked = 0;
        var inp_prod = $(".btn-check-product");

        for (let i = 0; i < inp_prod.length; i++) {
            if (inp_prod[i].checked) {
                num_products_checked++;
            }
        }

        if(num_products_checked > 0){
            $("#order-help").addClass("d-none");
        }

        if (num_products_checked == inp_prod.length) {
            $("#btn-check-all-cart").prop("checked", true);
        } else {
            $("#btn-check-all-cart").prop("checked", false);
        }
        update_total_price();
    });

    // Xử lý sự kiện nhấn nút tăng số lượng sản phẩm
    $(document).on("click", ".btn-increase-cart", function() {
        var productID = $(this).data("prodid");

        var inputQuantity = $(".input-quantity-cart[data-prodid='" + productID + "']");
        var currQuantity = inputQuantity.val();

        var productPrice = inputQuantity.data("prod_price");
        var stock = inputQuantity.data("prod_stock");

        var quantity = currQuantity;
        if (inputQuantity.val() < stock) {
            quantity = parseInt(currQuantity) + 1;
            inputQuantity.val(quantity);
            // Update quantity in database
            updateQuantity(productID, quantity);

            // Update amount
            update_amount(productID, productPrice, quantity);

            // Update total price
            update_total_price();
        }

    });

    // Xử lý sự kiện nhấn nút giảm số lượng sản phẩm
    $(document).on("click", ".btn-decrease-cart", function() {
        var productID = $(this).data("prodid");

        var inputQuantity = $(".input-quantity-cart[data-prodid='" + productID + "']");
        var currQuantity = inputQuantity.val();

        var productPrice = inputQuantity.data("prod_price");
        var stock = inputQuantity.data("prod_stock");

        var quantity = currQuantity;
        if (inputQuantity.val() > 1) {
            quantity = parseInt(currQuantity) - 1;
            inputQuantity.val(quantity);
            // Update quantity in database
            updateQuantity(productID, quantity);

            // Update amount
            update_amount(productID, productPrice, quantity);

            // Update total price
            update_total_price();
        }
    });

    // Xử lý sự kiện nhập số lượng sản phẩm
    $(".input-quantity-cart").on("input", function() {
        let numPattern = /^[0-9]+$/;
        var productID = $(this).data("prodid");
        var productPrice = $(this).data("prod_price");
        var stock = $(this).data("prod_stock");
        if (numPattern.test($(this).val()) == false || $(this).val() == 0) {
            $(this).val("1");
        }
        if ($(this).val() > stock) {
            $(this).val(stock);
        }
        var quantity = $(this).val();

        // Update quantity in database
        updateQuantity(productID, quantity);

        // Update amount
        update_amount(productID, productPrice, quantity);

        // Update total price
        update_total_price();

    })
</script>


<?php
include _DIR_ROOT . "/app/views/partials/footer.php";
?>