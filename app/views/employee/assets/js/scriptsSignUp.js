$(document).ready(function(){
    $("#hoten").change(function(){
        let namePattern = /[a-zA-Z]$/;
        if(namePattern.test($(this).val())== false){
            $("#nameNotification").text("Họ tên hợp lệ").css("color","red");
            $("#Signup").prop( "disabled", true );
            $("#username").prop( "disabled", true );
            $("#email").prop( "disabled", true );
            $("#sdt").prop( "disabled", true );
            $("#diachi").prop( "disabled", true );
            $("#pwd").prop( "disabled", true );
            $("#cpwd").prop( "disabled", true );
            $(this).focus();
        }
        else{
            $("#Signup").prop( "disabled", false );
            $("#username").prop( "disabled", false );
            $("#email").prop( "disabled", false );
            $("#sdt").prop( "disabled", false );
            $("#diachi").prop( "disabled", false );
            $("#pwd").prop( "disabled", false );
            $("#cpwd").prop( "disabled", false);
        }
    })
})


$(document).ready(function(){
    $("#username").change(function(){
        let userlPattern = /[a-zA-Z_0-9]$/;
        if(userlPattern.test($(this).val()) == false){
            $("#userNotification").text("Username không hợp lệ").css("color","red");
            $("#Signup").prop( "disabled", true );
            $("#hoten").prop( "disabled", true );
            $("#email").prop( "disabled", true );
            $("#sdt").prop( "disabled", true );
            $("#diachi").prop( "disabled", true );
            $("#pwd").prop( "disabled", true );
            $("#cpwd").prop( "disabled", true );
            $(this).focus();
        }
        else{
            $.ajax({
                url: "../Nhom10_CNPM_GoFish/Login-Signup/processCheckUserName.php",
                type: "post",
                data: {name:$(this).val()},

                success:function(res){
                    $("#userNotification").text(res).css("color","red");
                    $("#Signup").prop( "disabled", false );
                    $("#hoten").prop( "disabled", false );
                    $("#email").prop( "disabled", false );
                    $("#sdt").prop( "disabled", false );
                    $("#diachi").prop( "disabled", false );
                    $("#pwd").prop( "disabled", false );
                    $("#cpwd").prop( "disabled", false );
                }

            })
        }
    })
})

$(document).ready(function(){
    $("#email").change(function(){
        let emailPattern = /^[a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+.[a-zA-Z]{2,4}$/;
        if(emailPattern.test($(this).val())== false){
            $("#emailNotification").text("Email không hợp lệ").css("color","red");
            $("#Signup").prop( "disabled", true );
            $("#hoten").prop( "disabled", true );
            $("#username").prop( "disabled", true );
            $("#sdt").prop( "disabled", true );
            $("#diachi").prop( "disabled", true );
            $("#pwd").prop( "disabled", true );
            $("#cpwd").prop( "disabled", true );
            $(this).focus();
        }
        else{
            $.ajax({
                url: "../Nhom10_CNPM_GoFish/Login-Signup/processCheckEmail.php",
                type: "post",
                data: {email:$(this).val()},

                success:function(res){
                    $("#emailNotification").text(res).css("color","red");
                    $("#Signup").prop( "disabled", false );
                    $("#hoten").prop( "disabled", false );
                    $("#username").prop( "disabled", false );
                    $("#sdt").prop( "disabled", false );
                    $("#diachi").prop( "disabled", false );
                    $("#pwd").prop( "disabled", false );
                    $("#cpwd").prop( "disabled", false );
                }

            })
        }
    })
})


