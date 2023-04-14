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
            // include "../../config/constants.php";
            unset($_SESSION['empID']);
            unset($_SESSION['empName']);
            header("Location:" .SITEURL."employee/login");
        }

        public function loginProcess()
        {
            $employeeModel = new EmployeeModel();
            if (empty($_POST['emp']) || empty($_POST['pass'])) {
                $_SESSION['error'] = 'Bạn cần điền đầy đủ thông tin!';
                header("Location:" .SITEURL."login");
                exit();
            }
            $user = htmlspecialchars($_POST['emp']);
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
            $employeeModel = new EmployeeModel();
            if( !isset($_POST['btnSignUp']) ){
                header("location: ../signup.php");
            }
            else{
                if (empty($_POST['emp']) || empty($_POST['pass'])) {
                    $_SESSION['error'] = 'Bạn cần điền đầy đủ thông tin!';
                    header("Location:" .SITEURL."signup");
                    exit();
                }
                $user = htmlspecialchars($_POST['emp']);
                $password = htmlspecialchars($_POST['pass'], ENT_QUOTES);
        
                $res = $customerModel->signupProcess($user, $password);
                if ($res == 1) {
                    isset($_SESSION['cusID']);
                    isset($_SESSION['cusName']);
                    header("Location:" .SITEURL."index");
                }
            }
            
    
        }
        

    }
?>