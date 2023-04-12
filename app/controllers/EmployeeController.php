<?php
    require_once _DIR_ROOT.'/app/models/employees/EmployeeModel.php';
    
    class Employee {

        public function index() {
            $employeeModel = new EmployeeModel();
            $receiptps = $employeeModel->getAllReceiptp();
            
            // Sau khi truy vấn được dữ liệu,đổ ra 
            //View index
            require_once _DIR_ROOT.'/app/views/employee/index.php';
        }

        public function customerCare() {
            //View cskh
            require_once _DIR_ROOT.'/app/views/employee/customerCare.php';
        }
        
        public function report() {
            //View report
            require_once _DIR_ROOT.'/app/views/employee/reportView.php';
        }
        //-------Receiptp--------------
        //Hàm thay đổi trạng thái đơng hàng
        public function confirmReceiptp() {
            $employeeModel = new EmployeeModel();
            // Lấy ra thông tin
            if (isset($_GET['id']) && isset($_GET['choice'])) {
                $id = $_GET['id'];
                $status = $_GET['choice'];
            }

            //gọi model 
            $res = $employeeModel ->confirmReceiptp($id);

            if ($res) {
                $_SESSION['editSuccessStatus'] = "Xác nhận đơn thành công";
            }
            if ($res) {
                $_SESSION['editFailStatus'] = "Xác nhận đơn hàng thất bại";
            }
            header("Location:" .SITEURL."app/views/employee/index.php");
            exit();
        }
        
        public function refuseReceiptp() {
            $employeeModel = new EmployeeModel();
            // Lấy ra thông tin
            if (isset($_GET['id']) && isset($_GET['choice'])) {
                $id = $_GET['id'];
                $status = $_GET['choice'];
            }

            //gọi model 
            $res = $employeeModel ->refuseReceiptp($id);

            if ($res) {
                $_SESSION['editSuccessStatus'] = "Xác nhận đơn thành công";
            }
            if ($res) {
                $_SESSION['editFailStatus'] = "Xác nhận đơn hàng thất bại";
            }
            header("Location:" .SITEURL."app/views/employee/index.php");
            exit();
        } 
    }
?>