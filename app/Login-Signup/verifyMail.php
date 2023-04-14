<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Kích Hoạt Tài Khoản</title>
    <!-- CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
<?php
if($_GET['key'] && $_GET['token'])
{
    include "../config/constants.php";
    $email = $_GET['key'];
    $token = $_GET['token'];

    $sql= "SELECT * FROM users WHERE email_verification_link='$token' and `email`='$email'";
    $query = mysqli_query($conn,$sql);
    $d = date('Y-m-d H:i:s');
    if (mysqli_num_rows($query) > 0) {
        $row= mysqli_fetch_array($query);
        if($row['email_verified_at'] == NULL){
            $sql1="UPDATE users set email_verified_at ='$d', status= 1 WHERE email='$email'";
            mysqli_query($conn,$sql1);
            $msg = "Chúc mừng! Tài khoản của bạn đã được kích hoạt.";
        }else{
            $msg = "Tài khoản của bạn đã được kích hoạt rồi!!!";
        }
    } 
    else {
        $msg = "Tài khoản này chưa được đăng kí với chúng tôi. Vui lòng đăng ký lại!";
    }
}
else
{
    header('location: ../signup.php');
}
?>
    <div class="container mt-3">
        <div class="card">
            <div class="card-header text-center">
                Kích Hoạt Tài Khoản
            </div>
            <div class="card-body">
                <p>
                    <?php echo $msg; ?>
                </p>
                <a href="../login.php">Chuyển sang trang đăng nhập tại đây</a>
            </div>
        </div>
    </div>
</body>

</html>