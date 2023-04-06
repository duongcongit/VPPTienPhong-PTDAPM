<?php
require_once '../config/constants.php';
if(empty($_POST['admin']) || empty($_POST['pass'])) {
    $_SESSION['error'] = 'Bạn cần điền đầy đủ thông tin!';
    header('location:login.php');
    exit();
}
$user = htmlspecialchars($_POST['admin']);
$password = htmlspecialchars($_POST['pass'], ENT_QUOTES);

$sql = "SELECT * from admins where username = '$user' ";

$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) == 1){
    $row = mysqli_fetch_array($result);
    if($password == $row['password']){
        $_SESSION['adminID']=$row['adminID'];
        $_SESSION['adminName'] = $row['adminName'];
        header('location: index.php');
        exit();
    }
    else{
        $_SESSION['error'] = 'Sai mật khẩu!';
    }
        
}
else{
    $_SESSION['error'] = 'Kiểm tra lại tài khoản của bạn!';
}


mysqli_close($conn);

header('location:login.php');
