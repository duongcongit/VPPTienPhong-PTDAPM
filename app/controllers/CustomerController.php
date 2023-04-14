<?php
    require_once _DIR_ROOT.'/app/models/customers/CustomerModel.php';
    
    class Customer {
        public function login(){
            require_once _DIR_ROOT.'/app/views/loginView.php';
        }

        public function signup(){
            require_once _DIR_ROOT.'/app/views/signupView.php';
        }

        public function logout(){
            unset($_SESSION['cusID']);
            unset($_SESSION['cusName']);
            header("Location:" .SITEURL."login");
        }

        public function loginProcess()
        {
            $customerModel = new EmployeeModel();
            if (empty($_POST['user']) || empty($_POST['pass'])) {
                $_SESSION['error'] = 'Bạn cần điền đầy đủ thông tin!';
                header("Location:" .SITEURL."login");
                exit();
            }
            $user = htmlspecialchars($_POST['user']);
            $password = htmlspecialchars($_POST['pass'], ENT_QUOTES);
    
            $res = $customerModel->loginProcess($user, $password);
            if ($res == 1) {
                isset($_SESSION['cusID']);
                isset($_SESSION['cusName']);
                header("Location:" .SITEURL."index");
            }
    
        }
        public function signupProcess()
        {
            $customerModel = new CustomerModel();
            if( !isset($_POST['btnSignUp']) ){
                header("location: ../signup.php");
            }
            else{
                if (empty($_POST['emp']) || empty($_POST['pass'])) {
                    $_SESSION['error'] = 'Bạn cần điền đầy đủ thông tin!';
                    header("Location:" .SITEURL."signup");
                    exit();
                }
                $user = htmlspecialchars($_POST['name']);
                $password = htmlspecialchars($_POST['pass'], ENT_QUOTES);
                $name = htmlspecialchars($_POST['hoten']);
                $address = htmlspecialchars($_POST['diachi']);
                $phone = htmlspecialchars($_POST['sdt']); 
                $email = htmlspecialchars($_POST['email']);
                $token = md5($email).rand(10,9999);
                $pass_hash=password_hash($pass,PASSWORD_DEFAULT);
                $res = $customerModel->signupProcess($name,$address,$phone,$email,$user,$pass,$token);
                if ($res == 1) {
                    require_once  _DIR_ROOT.'/app/sendMail.php';
                    if(sendEmailForAccountActive($email,$res)){
                        echo "Vui lòng kiểm tra hộp thư của bạn để kích hoạt tài khoản";
                    }
                    else{
                        echo "Xin lỗi email chưa được gửi đi. Vui lòng kiểm tra thông tin tài khoản";
                    }
                }
            }
            
    
        }
        public function verifyMail($email,$token){
            $customerModel = new CustomerModel();
            $verify = $customerModel->verifyMail($email,$token);
            
            require_once _DIR_ROOT.'/app/views/verifyMail.php';
        }

        

    }
?>