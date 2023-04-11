<?php
    require_once '../../config/constants.php';
    class loginModel{
        private $conn;
        public function login($user, $pass) {
            $sql = "SELECT * from customers where email = ? or phone = ? and password = ?";

            $stmt = mysqli_prepare($conn, $sql);

        if($stmt){
            // Liên kết biến với tham số trong câu lệnh đã chuẩn bị
            mysqli_stmt_bind_param($stmt, "sss", $phone, $email, $password);
            
            if(mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1) {
                    mysqli_stmt_bind_result($stmt, $Id,$Ten, $Address, $tPhone,  $Email , $UserName ,$Password,  $status);
                    if(mysqli_stmt_fetch($stmt)) {
                        if($status == 1) {
                            if(password_verify($password, $Password)) {
                                $_SESSION['id'] = $Id;
                                $_SESSION['username'] = $UserName;
                                $_SESSION['email'] = $Email;
                                header('location: ../../index.php');
                                exit();
                            } else{
                                $_SESSION['error'] = 'Sai mật khẩu ';
                                header('location:../../view/login/loginView.php');
                                exit();
                            }
                        
                        } else {
                            $_SESSION['error'] = 'Vui lòng kích hoạt tài khoản ';
                        }
                    }
                } else {
                    $_SESSION['error'] = 'Hãy kiểm tra lại email và mật khẩu của bạn!';
                }
            }

        } else{
            $_SESSION['error'] = 'Không thể kết nối đến hệ thống';
        }
        }

        public function connectDb() {
            $connection = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
            if (!$connection) {
                die("Không thể kết nối. Lỗi: " .mysqli_connect_error());
            }
    
            return $connection;
        }
    
        public function closeDb($connection = null) {
            mysqli_close($connection);
        }
    }
?>