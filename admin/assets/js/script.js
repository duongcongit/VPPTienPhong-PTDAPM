$(document).ready(function () {
    $(".nav-mng-product").on("click", function () {
        //
        $(".nav-mng-product").removeClass("active");
        $(this).addClass("active");
    });

    // For click menu button, show/hide sidebar
    $("#btn-menu").click(function () {
        $(".sidebar").toggleClass("sidebar-show");
        $(".main-right").toggleClass("show");
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
