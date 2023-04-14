// === Function ===
const addToCart = (customerID, productID, quantity, SITEURL) => {

    $.ajax({
        url: SITEURL + "customer/addProductToCart",
        type: "POST",
        data: {
            productID: productID,
            quantity: quantity
        },
        success: function (data) {
            if (data.toString() == "Exceed the available quantity") {
                console.log("Quá số lượng");
                let modalFail = bootstrap.Modal.getOrCreateInstance(
                    document.querySelector(".modal-fail")
                );

                $("#modal-fail-message").text("Vượt quá số lượng sản phẩm có sẵn. Không thể thêm!");
                modalFail.show();
                setTimeout(function () {
                    modalFail.hide();
                }, 1000);

            }
            else {
                console.log("Đã thêm vào giỏ hàng");
                let modalSucc = bootstrap.Modal.getOrCreateInstance(
                    document.querySelector(".modal-success")
                );

                $("#modal-success-message").text("Đã thêm vào giỏ hàng");
                modalSucc.show();
                setTimeout(function () {
                    modalSucc.hide();
                }, 1000);
            }

        }
    })
    // 
}

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

$(document).ready(function () {

    // ======= Home Page =======
    // const SITEURL = "<?php echo SITEURL; ?>";
    $(".btn-add-to-cart").on("click", function () {
        var customerID = $(this).data("customer_id");
        var productID = $(this).data("product_id");
        var quantity = 1;
        addToCart(customerID, productID, quantity, SITEURL);
    });

    // ======= Detail page =======
    // Check when quantity is changed
    $("#input-quantity-detail").on("input", function () {
        let numPattern = /^[0-9]+$/;
        var stock = $(this).data("prod_stock");
        if (numPattern.test($(this).val()) == false || $(this).val() == 0) {
            $(this).val("1");
        }
        if ($(this).val() > $(this).data("prod_stock")) {
            $(this).val($(this).data("prod_stock"));
        }
    })

    // When click button increase quantity
    $("#btn-increase-quantity-detail").on("click", function () {
        var currQuantity = $("#input-quantity-detail").val();
        var stock = $("#input-quantity-detail").data("prod_stock");
        if (parseInt(currQuantity) < stock) {
            $("#input-quantity-detail").val(parseInt(currQuantity) + 1);
        }

    });
    // When click button decrease quantity
    $("#btn-decrease-quantity-detail").on("click", function () {
        var currQuantity = $("#input-quantity-detail").val();
        var stock = $(this).data("prod_stock");
        if (parseInt(currQuantity) > 1) {
            $("#input-quantity-detail").val(parseInt(currQuantity) - 1);
        }
    });

    $(".btn-add-to-cart-detail").on("click", function () {
        var customerID = $(this).data("customer_id");
        var productID = $(this).data("product_id");
        var quantity = $("#input-quantity-detail").val();
        addToCart(customerID, productID, quantity, SITEURL);
    });

    // ======= Cart page =======
    // Cập nhật số lượng
    function updateQuantity(productID, quantity) {

        $.ajax({
            url: SITEURL + "customer/updateQuantityInCart",
            type: "POST",
            data: {
                productID: productID,
                quantity: quantity
            },
            success: function (data) {
                // console.log("Cập nhật giỏ hàng thành công");
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
        $(".btn-check-product[data-prodid='" + productID + "']").attr({
            value: parseInt(amount),
            'data-quantity': quantity
        });

    }

    // Cập nhật danh sách các sản phẩm muốn mua
    function updateProductOrder() {
        let orderDataCart = $("#order-data-cart")[0];
        $("#order-data-cart").html("");
        var num_inp = $(".btn-check-product").length;
        var num_prod = 0;

        let j = 0;
        for (let i = 0; i < num_inp; i++) {
            // let inp = $(".btn-check-product:eq(" + i + ")");
            if ($(".btn-check-product:eq(" + i + ")").is(":checked")) {
                // let inp = $(".btn-check-product:eq(" + i + ")");
                let inp = document.getElementsByClassName("btn-check-product")[i];
                let prID = inp.getAttribute("data-prodid");
                let prName = inp.getAttribute("data-product_name");
                let prImage = inp.getAttribute("data-product_image");
                let prPrice = inp.getAttribute("data-price");
                let quant = inp.getAttribute("data-quantity");

                let value = [prID, prName, prImage, prPrice, quant];

                // console.log(prID + " - " + quant);

                $('<input>').attr({
                    type: 'hidden',
                    class: "product-order-from-cart",
                    name: "product"+j,
                    value: value
                }).appendTo(orderDataCart);
                j++;

            }
        }

    }

    // updateProductOrder();

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
        if (num_prod > 0) {
            $("#order-help").addClass("d-none");
        }
        else {

        }
        //
        $(".number-product-checked").text(num_prod + " (Sản phẩm)");
        $(".total-price").html(format_price(amount) + '<u class="ms-1">đ</u>');

        updateProductOrder();
    }

    // Xử lý sự kiện nhấn nút chọn tất cả sản phẩm
    $(document).on("change", "#btn-check-all-cart", function () {
        if (this.checked) {
            $(".btn-check-product").prop("checked", true);
        } else {
            $(".btn-check-product").prop("checked", false);
        }
        //
        update_total_price();
    });

    // Xử lý sự kiện nhấn nút chọn một sản phẩm
    $(document).on("change", ".btn-check-product", function () {

        var num_products_checked = 0;
        var inp_prod = $(".btn-check-product");

        for (let i = 0; i < inp_prod.length; i++) {
            if (inp_prod[i].checked) {
                num_products_checked++;
            }
        }

        if (num_products_checked > 0) {
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
    $(document).on("click", ".btn-increase-cart", function () {
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
    $(document).on("click", ".btn-decrease-cart", function () {
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
    $(".input-quantity-cart").on("input", function () {
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

    // Xự kiện nhấn nút xóa một sản phẩm trong giỏ hàng
    $(document).on("click", ".btn-remove-product-cart", function () {
        var productID = $(this).data("prodid");

        let modalConfirm = bootstrap.Modal.getOrCreateInstance(
            document.querySelector(".modal-confirm")
        );
        $("#modal-confirm-title").text("Xóa sản phẩm này khỏi giỏ hàng?");
        modalConfirm.show();

        $("#btn-confirm").on("click", function () {
            $.ajax({
                url: SITEURL + "customer/removeProductFromCart",
                type: "POST",
                data: {
                    productID: productID,
                },
                success: function (data) { },
            });
            //
            modalConfirm.hide();
            location.reload();
        });

    })

    // Xự kiện nhấn nút xóa tất cả sản phẩm trong giỏ hàng
    $(document).on("click", ".btn-clear-cart", function () {
        let modalConfirm = bootstrap.Modal.getOrCreateInstance(
            document.querySelector(".modal-confirm")
        );
        $("#modal-confirm-title").text("Xóa tất cả sản phẩm khỏi giỏ hàng?");
        modalConfirm.show();

        $("#btn-confirm").on("click", function () {
            $.ajax({
                url: SITEURL + "customer/clearCart",
                type: "POST",
                data: {},
                success: function (data) { },
            });
            //
            modalConfirm.hide();
            location.reload();
        });
    })


})

