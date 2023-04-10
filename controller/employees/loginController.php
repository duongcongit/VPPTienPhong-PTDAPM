<?php

require_once '../../model/login/loginModel.php';

class LoginController {
  
  public function login() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Nếu đã đăng nhập, chuyển hướng người dùng đến trang chính
      if( !isset($_POST['btnLogIn']) ){
        header("location: ../../view/login/loginView.php");
    }
    else{
        if(empty($_POST['user']) || empty($_POST['pass'])) {
        $_SESSION['error'] = 'Bạn cần điền đầy đủ thông tin!';
        header('location:../../view/login/loginView.php');
        exit();
    }
    // Lấy thông tin đăng nhập từ form
    $phone =  htmlspecialchars($_POST['user']);
    $password = htmlspecialchars($_POST['pass'], ENT_QUOTES);
    $email = $phone;
    $email =  htmlspecialchars($email);
        
    // Tìm kiếm người dùng trong CSDL
    $userModel = new User();
    $user = $userModel->login($username, $password);
        
    // Nếu người dùng tồn tại, lưu thông tin vào session và chuyển hướng đến trang chính
    if ($user) {
        $_SESSION['user'] = $user;
        header('Location: ../../index.php');
        exit();
        } else {
            // Nếu người dùng không tồn tại, hiển thị thông báo lỗi
            $errorMessage = 'Tên đăng nhập hoặc mật khẩu không đúng';
        }

    // Load view đăng nhập
    require_once '../../view/login/loginView.php';
  }
}
}
}
?>