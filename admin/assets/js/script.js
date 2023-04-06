// ====== Scripts for show products page
function showProductsData(tableID, type, page, numRow, sortBy) {
  $.ajax({
    url: "get-products-data.php",
    type: "POST",
    data: {
      tableID: tableID,
      type: type,
      page: page,
      numRow: numRow,
      sortBy: sortBy,
    },
    success: function (data) {
      $("#table-products").html(data);
    },
  });
}


$(document).ready(function () {
  $(".nav-mng-product").on("click", function () {
    //
    $(".nav-mng-product").removeClass("active");
    $(this).addClass("active");
    var val = $(this).text();
    var type = "";
    //
    if (val == "Tất cả") {
      type = "all";
      showProductsData("table-products", "all", 1, 20, "productID asc");
      // Set url
      //var url     = "?table=" + tableID + "&page=" + page + "&numrow=" + numRow + "&sortby=" + sortBy;
      var url     = "?productstype=all";
      history.pushState(null, "", url);
    } else if (val == "Đang hoạt động") {
      type = "active";
      showProductsData("table-products", "active", 1, 20, "productID asc");
      // Set url
      var url     = "?productstype=active";
      history.pushState(null, "", url);
    } else if (val == "Hết hàng") {
      type = "run_out";
      showProductsData("table-products", "run_out", 1, 20, "productID asc");
      // Set url
      var url     = "?productstype=run_out";
      history.pushState(null, "", url);
    } else if (val == "Bị khóa") {
      type = "locked";
      showProductsData("table-products", "locked", 1, 20, "productID asc");
      // Set url
      var url     = "?productstype=locked";
      history.pushState(null, "", url);
    }
    //
    var count_product = "0";
    $.ajax({
      url: "count-products.php",
      type: "POST",
      data: { type: type },
      success: function (data) {
        var result = $.trim(data);
        $("#label-count-prod").text(result + " Sản phẩm");
      },
      error: function (jqXHR, exception) {
        //alert("Lỗi");
      },
    });
    
    //
  });

  // For click menu button, show/hide sidebar
  $("#btn-menu").click(function () {
    $(".sidebar").toggleClass("sidebar-show");
    $(".main-right").toggleClass("show");
  });

  // Expand subpage in sidebar menu
  $(".tour-btn").click(function () {
    $(".sidebar-menu ul .tour-show").toggleClass("show");
    $(".sidebar-menu ul .tour-caret").toggleClass("rotate");
  });

  //
  $("#del-photo-1").on("click", function () {
    document.getElementById("photo-1-preview").src =
      "../assets/img/no-image.png";
    $("#photo-1-input").val("");
  });
  //
  $("#del-photo-2").on("click", function () {
    document.getElementById("photo-2-preview").src =
      "../assets/img/no-image.png";
    $("#photo-2-input").val("");
  });
  //
  $("#del-photo-3").on("click", function () {
    document.getElementById("photo-3-preview").src =
      "../assets/img/no-image.png";
    $("#photo-3-input").val("");
  });

  //
  $("#del-photo-1-edit").on("click", function () {
    document.getElementById("photo-1-preview").src =
      "../assets/img/no-image.png";
    $("#photo-1-input").val("");
    $("[name='isphoto1editempty']").val("TRUE");
  });
  //
  $("#del-photo-2-edit").on("click", function () {
    document.getElementById("photo-2-preview").src =
      "../assets/img/no-image.png";
    $("#photo-2-input").val("");
    $("[name='isphoto2editempty']").val("TRUE");
  });
  //
  $("#del-photo-3-edit").on("click", function () {
    document.getElementById("photo-3-preview").src =
      "../assets/img/no-image.png";
    $("#photo-3-input").val("");
    $("[name='isphoto3editempty']").val("TRUE");
  });

  //
  let pricePattern = /^[0-9]+$/;

  //

  //
  // showProductsData("table-products", "all", 1, 20, "productID asc");

  //

  // Script for process add product

  $(document).on("click", "#btn-add-product", function () {
    // Check name
    if ($("[name='prodNameAdd']").val() == "") {
      $("[name='prodNameAdd']").css("border", "solid 2px red");
      window.scrollTo(0, 0);
      event.preventDefault();
    } else {
      $("[name='prodNameAdd']").css("border", "");
    }

    // Check detail
    if ($("[name='prodDetailAdd']").val() == "") {
      $("[name='prodDetailAdd']").css("border", "solid 2px red");
      window.scrollTo(0, 0);
      event.preventDefault();
    } else {
      $("[name='prodDetailAdd']").css("border", "");
    }

    // Check category
    if ($("[name='prodCategoryAdd']").val() == 0) {
      $("[name='prodCategoryAdd']").css("border", "solid 2px red");
      window.scrollTo(0, 0);
      event.preventDefault();
    } else {
      $("[name='prodCategoryAdd']").css("border", "");
    }

    // Check price
    var price = $("[name='prodPriceAdd']").val();
    if (price != "" && pricePattern.test(price) == false) {
      $("[name='prodPriceAdd']").css("border", "solid 2px red");
      window.scrollTo(0, 0);
      event.preventDefault();
    } else if (price == "") {
      $("[name='prodPriceAdd']").css("border", "");
      $("[name='prodPriceAdd']").val("0");
    } else {
      $("[name='prodPriceAdd']").css("border", "");
    }

    // Check stock
    var stock = $("[name='prodStockAdd']").val();
    if (stock != "" && pricePattern.test(stock) == false) {
      $("[name='prodStockAdd']").css("border", "solid 2px red");
      window.scrollTo(0, 0);
      event.preventDefault();
    } else if (stock == "") {
      $("[name='prodStockAdd']").css("border", "");
      $("[name='prodStockAdd']").val("0");
    } else {
      $("[name='prodStockAdd']").css("border", "");
    }

    // Check image
    if (
      $("#photo-1-input").val() == "" &&
      $("#photo-2-input").val() == "" &&
      $("#photo-3-input").val() == ""
    ) {
      $(".waring-no-image-add").removeClass("d-none");
      event.preventDefault();
    } else {
      $(".waring-no-image-add").addClass("d-none");
    }

    //event.preventDefault();
  });

  // Check Name
  $("[name='prodNameAdd']").on("change", function () {
    var productName = $(this).val();
    if (productName != "") {
      $.ajax({
        url: "check-product-name.php",
        type: "POST",
        data: { productName: productName },
        success: function (data) {
          var result = $.trim(data);
          if (result == productName) {
            $("#prodNameAddHelp").text(
              "(!) Đã tồn tại sản phẩm khác có tên này trong gian hàng của bạn. Vui lòng kiểm tra lại!"
            );
            $("#prodNameAddHelp").css("color", "red");
            $("#btn-add-product").attr("disabled", "disabled");
          } else {
            $("#prodNameAddHelp").text("");
            $("#btn-add-product").removeAttr('disabled');
          }
        },
        error: function (jqXHR, exception) {
          //alert("Lỗi");
        },
      });
    } else {
      $("#prodNameAddHelp").text("");
      $("#btn-add-product").removeAttr('disabled');
    }
  });

  // Check product SKU

  // Check SKU
  $("[name='prodSKUAdd']").on("change", function () {
    var productSKU = $(this).val();
    if (productSKU != "") {
      $.ajax({
        url: "check-product-sku.php",
        type: "POST",
        data: { productSKU: productSKU },
        success: function (data) {
          var result = $.trim(data);
          if (result == productSKU) {
            $("#prodSKUAddHelp").text(
              "(!) Đã tồn tại sản phẩm khác có mã SKU này. Vui lòng kiểm tra lại!"
            );
            $("#prodSKUAddHelp").css("color", "red");
            $("#btn-add-product").attr("disabled", "disabled");
          } else {
            $("#prodSKUAddHelp").text("");
            $("#btn-add-product").removeAttr('disabled');
          }
        },
        error: function (jqXHR, exception) {
          //alert("Lỗi");
        },
      });
    } else {
      $("#prodSKUAddHelp").text("");
      $("#btn-add-product").removeAttr('disabled');
    }
  });

  // Script for process Edit product

  $(document).on("click", "#btn-edit-product", function () {
    // Check name
    if ($("[name='prodNameEdit']").val() == "") {
      $("[name='prodNameEdit']").css("border", "solid 2px red");
      window.scrollTo(0, 0);
      event.preventDefault();
    } else {
      $("[name='prodNameEdit']").css("border", "");
    }

    // Check detail
    if ($("[name='prodDetailEdit']").val() == "") {
      $("[name='prodDetailEdit']").css("border", "solid 2px red");
      window.scrollTo(0, 0);
      event.preventDefault();
    } else {
      $("[name='prodDetailEdit']").css("border", "");
    }

    // Check category
    if ($("[name='prodCategoryEdit']").val() == 0) {
      $("[name='prodCategoryEdit']").css("border", "solid 2px red");
      window.scrollTo(0, 0);
      event.preventDefault();
    } else {
      $("[name='prodCategoryEdit']").css("border", "");
    }

    // Check price
    var price = $("[name='prodPriceEdit']").val();
    if (price != "" && pricePattern.test(price) == false) {
      $("[name='prodPriceEdit']").css("border", "solid 2px red");
      window.scrollTo(0, 0);
      event.preventDefault();
    } else if (price == "") {
      $("[name='prodPriceEdit']").css("border", "");
      $("[name='prodPriceEdit']").val("0");
    } else {
      $("[name='prodPriceEdit']").css("border", "");
    }

    // Check stock
    var stock = $("[name='prodStockEdit']").val();
    if (stock != "" && pricePattern.test(stock) == false) {
      $("[name='prodStockEdit']").css("border", "solid 2px red");
      window.scrollTo(0, 0);
      event.preventDefault();
    } else if (stock == "") {
      $("[name='prodStockEdit']").css("border", "");
      $("[name='prodStockEdit']").val("0");
    } else {
      $("[name='prodStockEdit']").css("border", "");
    }

    // Check image
    if (
      $("[name='isphoto1editempty']").val() == "" &&
      $("[name='isphoto2editempty']").val() == "" &&
      $("[name='isphoto3editempty']").val() == ""
    ) {
      $(".waring-no-image-edit").removeClass("d-none");
      event.preventDefault();
    } else {
      $(".waring-no-image-Edit").AddClass("d-none");
    }

    //event.preventDefault();
  });

  // Check product Name
  $("[name='prodNameEdit']").on("change", function () {
    var currProdName = $(this).data("curr_prod_name");
    var newProductName = $(this).val();
    if (newProductName != "") {
      $.ajax({
        url: "check-product-name.php",
        type: "POST",
        data: { productName: newProductName },
        success: function (data) {
          var result = $.trim(data);
          if (result == newProductName && newProductName != currProdName) {
            $("#prodNameEditHelp").text(
              "(!) Đã tồn tại sản phẩm khác có tên này trong gian hàng của bạn. Vui lòng kiểm tra lại!");
            $("#prodNameEditHelp").css("color", "red");
            $("#btn-edit-product").attr("disabled", "disabled");
          } else if (result == currProdSKU) {
            $("#prodNameEditHelp").text("");
            $("#btn-edit-product").removeAttr('disabled');
          } else {
            $("#prodNameEditHelp").text("");
            $("#btn-edit-product").removeAttr('disabled');
          }
        },
        error: function (jqXHR, exception) {
          //alert("Lỗi");
        },
      });
    } else {
      $("#prodNameEditHelp").text("");
      $("#btn-edit-product").removeAttr('disabled');
    }
  });

  // Check product SKU
  $("[name='prodSKUEdit']").on("change", function () {
    var currProdSKU = $(this).data("curr_prod_sku");
    var newProductSKU = $(this).val();
    if (newProductSKU != "") {
      $.ajax({
        url: "check-product-sku.php",
        type: "POST",
        data: { productSKU: newProductSKU },
        success: function (data) {
          var result = $.trim(data);
          if (result == newProductSKU && newProductSKU != currProdSKU) {
            $("#prodSKUEditHelp").text(
              "(!) Đã tồn tại sản phẩm khác có mã SKU này. Vui lòng kiểm tra lại!"
            );
            $("#prodSKUEditHelp").css("color", "red");
            $("#btn-edit-product").attr("disabled", "disabled");
          } else if (result == currProdSKU) {
            $("#prodSKUEditHelp").text("");
            $("#btn-edit-product").removeAttr('disabled');
          } else {
            $("#prodSKUEditHelp").text("");
            $("#btn-edit-product").removeAttr('disabled');
          }
        },
        error: function (jqXHR, exception) {
          //alert("Lỗi");
        },
      });
    } else {
      $("#prodSKUEditHelp").text("");
      $("#btn-edit-product").removeAttr('disabled');
    }
  });

  // Scripts for process update stock
  // Create modal update stock
  var modalUpdateEl = document.querySelector("#modalUpdateStock");
  var modalUpdateStock = bootstrap.Modal.getOrCreateInstance(modalUpdateEl);

  $(document).on("click", ".btn-update-stock", function () {
    modalUpdateStock.show();
    var productID = $(this).data("productid");
    var productSKU = $(this).data("productsku");
    var currentStock = $(this).data("productstock");
    $("#stockUpdateInput").val(currentStock);

    // Update stock
    $("#stockUpdateConf").on("click", function () {
      var stock = $("#stockUpdateInput").val();
      if (pricePattern.test(stock) == false || stock == "") {
        $("#stockUpdateInput").css("border", "solid 2px red");
        event.preventDefault();
      } else {
        $("#stockUpdateInput").css("border", "");
        //
        $.ajax({
          url: "process-update-stock.php",
          type: "POST",
          data: {
            productID: productID,
            stock: stock,
            productSKU: productSKU,
          },
          success: function (data) {
            var result = $.trim(data);
            if (result == "success") {
              showProductsData("table-products", "all", 1, 20, "productID asc");
              $(".alert-update-success").removeClass("d-none");
              $("#alert-success-content").text(
                "Đã cập nhật thông tin kho hàng sản phẩm "
              );
              $("#alert-success-taget").text("SKU: " + productSKU);
            } else {
              //alert("Lỗi");
            }
          },
          error: function (jqXHR, exception) {
            //alert("Lỗi");
          },
        });
        //
        modalUpdateStock.hide();
      }
      //
    });
    //
  });
});
