<?php
require_once _DIR_ROOT . '/app/models/EmployeeModel.php';

class Employee
{
    public function login()
    {
        require_once _DIR_ROOT . '/app/views/employee/loginView.php';
    }

    public function logout()
    {
        // include "../../config/constants.php";
        unset($_SESSION['empID']);
        unset($_SESSION['empName']);
        header("Location:" . SITEURL . "employee/login");
    }

    public function loginProcess()
    {
        $employeeModel = new EmployeeModel();
        if (empty($_POST['emp']) || empty($_POST['pass'])) {
            $_SESSION['error'] = 'Bạn cần điền đầy đủ thông tin!';
            header("Location:" . SITEURL . "employee/login");
            exit();
        }
        $user = htmlspecialchars($_POST['emp']);
        $password = htmlspecialchars($_POST['pass'], ENT_QUOTES);

        $res = $employeeModel->loginProcess($user, $password);
        if ($res == 1) {
            isset($_SESSION['empID']);
            isset($_SESSION['empName']);
            header("Location:" . SITEURL . "employee/");
        } else {
            $_SESSION['error'] = 'Bạn nhập sai tên đăng nhập hoặc mật khẩu rồi!!!';
            header("Location:" . SITEURL . "employee/login");
            exit();
        }
    }

    public function index()
    {
        $employeeModel = new EmployeeModel();
        $receiptps = $employeeModel->getAllReceiptp();

        // Sau khi truy vấn được dữ liệu,đổ ra 
        //View index
        require_once _DIR_ROOT . '/app/views/employee/index.php';
    }

    public function customerCare()
    {
        //View cskh
        require_once _DIR_ROOT . '/app/views/employee/customerCare.php';
    }

    public function report()
    {
        //View report
        require_once _DIR_ROOT . '/app/views/employee/reportView.php';
    }
    //-------Receiptp--------------
    //Hàm thay đổi trạng thái đơng hàng
    public function confirmReceiptp($id)
    {
        $employeeModel = new EmployeeModel();
        // Lấy ra thông tin
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        if (isset($_SESSION['empID'])) {

            $empID = $_SESSION['empID'];
            //gọi model 
            $res = $employeeModel->confirmReceiptp($id, $empID);

            if ($res) {
                $_SESSION['editSuccessStatus'] = "Xác nhận đơn thành công";
            }
            if ($res) {
                $_SESSION['editFailStatus'] = "Xác nhận đơn hàng thất bại";
            }
            header("Location:" . SITEURL . "employee/");
            exit();
        }
    }

    public function refuseReceiptp($id)
    {
        $employeeModel = new EmployeeModel();
        // Lấy ra thông tin
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        if (isset($_SESSION['empID'])) {

            $empID = $_SESSION['empID'];
            //gọi model 
            $res = $employeeModel->refuseReceiptp($id, $empID);

            if ($res) {
                $_SESSION['editSuccessStatus'] = "Hủy đơn thành công";
            }
            if ($res) {
                $_SESSION['editFailStatus'] = "Hủy đơn hàng thất bại";
            }
            header("Location:" . SITEURL . "employee/");
            exit();
        }
    }

    public function detail($id)
    {
        $employeeModel = new EmployeeModel();
        // Lấy ra thông tin
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        $details = $employeeModel->getReceiptDetail($id);
        $total = 0;

        if (!$details) {
            echo "Không thể lấy được thông tin đơn hàng";
        } else {
            foreach ($details as $detail) {
                $total = $total + $detail['total'];
            }
            require_once _DIR_ROOT . '/app/views/employee/detailReceiptp.php';
        }
    }
}
