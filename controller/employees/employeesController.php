<?php
    require_once '../../model/employees/employeesModel.php';
    
    class EmployeeController{
        public function index() {
            $employeeModel = new EmployeeModel();
            $receiptps = $employeeModel->getAllReceiptp();
            // Sau khi truy vấn được dữ liệu,đổ ra 
            //View index
            require_once '../../view/employees/index.php';
        }

        //-------Receiptp--------------
        //Hàm thay đổi trạng thái đơng hàng
        public function changeStatusReceiptp() {
            $employeeModel = new EmployeeModel();
            // Lấy ra thông tin
            if (isset($_GET['id']) && isset($_GET['choice'])) {
                $id = $_GET['id'];
                $status = $_GET['choice'];
            }

            //gọi model 
            $res = $employeeModel ->changeStatusReceiptp($id, $status);

            if ($res) {
                $_SESSION['editSuccessStatus'] = "Xác nhận đơn thành công";
            }
            if ($res) {
                $_SESSION['editFailStatus'] = "Thay đổi trạng thái của khách hàng có mã #$id thất bại";
            }
            header("Location: ../../view/employees/index.php");
            exit();
        } 
    }
?>