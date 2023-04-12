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
