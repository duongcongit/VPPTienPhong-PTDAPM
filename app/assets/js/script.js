// === Function ===
const addToCart = (customerID, productID, quantity, SITEURL) => {

    $.ajax({
        url: SITEURL + "customer/addProductToCart",
        type: "POST",
        data: {
            customerID: customerID,
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
                }, 2000000);

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
                }, 2000000);
            }

        }
    })
    // 
}

$(document).ready(function () {

    // Home Page
    // const SITEURL = "<?php echo SITEURL; ?>";
    $(".btn-add-to-cart").on("click", function () {
        var customerID = $(this).data("customer_id");
        var productID = $(this).data("product_id");
        var quantity = 1;
        addToCart(customerID, productID, quantity, SITEURL);
    });

    // Detail page

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



})

