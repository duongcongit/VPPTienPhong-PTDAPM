$(document).ready(function(){
    $("#emp").change(function(){
        let namePattern = /[a-zA-Z_0-9]$/;
        if(namePattern.test($(this).val())== false && emailPattern.test($(this).val())==false){
            $("#userNotification").text("Tài khoản không hợp lệ").css("color","red");
            $("#pwd").prop( "disabled", true );
            $("#btnLogIn").prop( "disabled", true );
            $(this).focus();
        }
        else{
            $("#userNotification").text("");
            $("#pwd").prop( "disabled", false );
            $("#btnLogIn").prop( "disabled", false);
        }
    })
})