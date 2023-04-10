$(document).ready(function () {

    // Home Page
    // const SITEURL = "<?php echo SITEURL; ?>";
    $(".btn-add-to-cart").on("click", function () {
        var customerID = $(this).data("customer_id");
        var productID = $(this).data("product_id");
        var quantity = 1;

        $.ajax({
            url: "customer/addProductToCart",
            type: "POST",
            data: {
                customerID: customerID,
                productID: productID,
                quantity: quantity
            },
            success: function (data) {
                console.log("Thêm vào giỏ hàng thành công");
            }
        })
        // 

    });


    // Detail product page




})

