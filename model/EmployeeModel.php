<?php
    require_once './../config/constants.php';

    class EmployeeModel{
        private $employeeID;
        private $fullname;
        private $gender;
        private $address;
        private $phone;
        private $email;
        private $username;
        private $password;
        private $status;

        // Định nghĩa các phương thức để sau này nhận các thao tác tương ứng với các action
        public function getAllEmployees(){
            // B1. Khởi tạo kết nối
            $conn = $this->connectDb();
            // B2. Định nghĩa và thực hiện truy vấn
            $sql = "SELECT * FROM employees";
            $result = mysqli_query($conn,$sql);

            // Tôi khai báo biến lưu kết quả trả về (dạng mảng)
            $arr_employees = [];
            // B3. Xử lý và (KO PHẢI SHOW KẾT QUẢ) TRẢ VỀ KẾT QUẢ
            if(mysqli_num_rows($result) > 0){
                // Lấy tất cả dùng mysqli_fetch_all
                $arr_employees = mysqli_fetch_all($result, MYSQLI_ASSOC); //Sử dụng MYSQLI_ASSOC để chỉ định lấy kết quả dạng MẢNG KẾT HỢP
            }

            return $arr_employees;
        }

        // Hàm lấy dữ liệu theo ID
        public function getEmployeeById($id) {
            $connection = $this->connectDb();
            $querySelect = "SELECT * FROM employees WHERE employeeID='$id'";
            $results = mysqli_query($connection, $querySelect);
            $employee = [];
            if (mysqli_num_rows($results) > 0) {
                $employees = mysqli_fetch_all($results, MYSQLI_ASSOC);
                $employee = $employees[0];
            }
            $this->closeDb($connection);
    
            return $employee;
        }
        
        //---------------ADMIN-------------------
        //Hàm thêm nhân viên
        public function insertEmployee($arr = []) {
            $connection = $this->connectDb();
            $sql_add_employee = "INSERT INTO employees (employeeID, fullname, gender, phone, email,username,password,status,address) VALUES ('{$arr['employeeID']}', '{$arr['employeeName']}', '{$arr['employeeGender']}','{$arr['employeePhone']}', '{$arr['employeeEmail']}','{$arr['employeeUsername']}','{$arr['employeePass']}',1, '{$arr['employeeAddress']}');";
            echo $sql_add_employee;
            $insert_employee = mysqli_query($connection,$sql_add_employee);
            $this->closeDb($connection);
            return $insert_employee;
        }


         //Hàm sửa thông tin nhân viên
         public function updateEmployee($arr = []) {
            $connection = $this->connectDb();
            $queryUpdate = "UPDATE employees
            SET `fullname` = '{$arr['employeeName']}',`gender` = '{$arr['employeeGender']}',`address` = '{$arr['employeeAddress']}',`phone` = '{$arr['employeePhone']}',`email` = '{$arr['employeeEmail']}',`username` = '{$arr['employeeUsername']}',`password` = '{$arr['employeePass']}',`status` = '{$arr['employeeStatus']}'
            WHERE `employeeID` = {$arr['employeeId']}";        
            $isUpdate = mysqli_query($connection, $queryUpdate);
            $this->closeDb($connection);
    
            return $isUpdate;
        }

        // Ham xóa tất cả nhân viên
        public function deleteAllEmployee() {
            $connection = $this->connectDb();
            $queryDelete = "DELETE FROM employees";
            $isDelete = mysqli_query($connection, $queryDelete);
            $this->closeDb($connection);      
            return $isDelete;
        }

        
        // Ham xóa nhân viên với Id cụ thể
        public function deleteEmployee($id=null) {
            $connection = $this->connectDb();
            $queryDelete = "DELETE FROM employees WHERE employeeID = '$id'";
            $isDelete = mysqli_query($connection, $queryDelete);
            $this->closeDb($connection);
                        
            return $isDelete;
        }
        //---------------------------

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