<?php
    require_once _DIR_ROOT.'/app/config/constants.php';

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
        // kiểm tra xem đã tồn tại tài khoản
        public function checkEmployeeUserName($username)
        {
            $connection = $this->connectDb();
            $querySelect = "SELECT * FROM employees WHERE username='$username'";
            $results = mysqli_query($connection, $querySelect);
            if (mysqli_num_rows($results) > 0) {
                return 1;
            }
            $this->closeDb($connection);
            return 0;
        }

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
            SET `fullname` = '{$arr['employeeName']}',`gender` = '{$arr['employeeGender']}',`address` = '{$arr['employeeAddress']}',`phone` = '{$arr['employeePhone']}',`email` = '{$arr['employeeEmail']}',`password` = '{$arr['employeePass']}',`status` = '{$arr['employeeStatus']}'
            WHERE `employeeID` = {$arr['employeeId']}";        
            $isUpdate = mysqli_query($connection, $queryUpdate);
            $this->closeDb($connection);
    
            return $isUpdate;
        }

        // Ham xóa tất cả nhân viên
        public function deleteAllEmployee() {
            $connection = $this->connectDb();
            $queryDelete = "UPDATE employees SET status = 2";
            // $queryDelete = "DELETE FROM employees";
            $isDelete = mysqli_query($connection, $queryDelete);
            $this->closeDb($connection);      
            return $isDelete;
        }

        
        // Ham xóa nhân viên với Id cụ thể
        public function deleteEmployee($id=null) {
            $connection = $this->connectDb();
            $queryDelete = "UPDATE employees SET status = 2 WHERE employeeID = '$id'";
            $isDelete = mysqli_query($connection, $queryDelete);
            $this->closeDb($connection);
                        
            return $isDelete;
        }
        //---------------------------

        public function loginProcess($user,$pass){
            $conn = $this->connectDb();
            // B2. Định nghĩa và thực hiện truy vấn
            $sql = "SELECT * FROM employees WHERE username = '$user' AND password = '$pass'";
            $result = mysqli_query($conn,$sql);

            // B3. Xử lý và (KO PHẢI SHOW KẾT QUẢ) TRẢ VỀ KẾT QUẢ
            if(mysqli_num_rows($result) == 1){
                $row = mysqli_fetch_array($result);
                if($pass == $row['password']){
                    $_SESSION['empID']=$row['employeeID'];
                    $_SESSION['empName'] = $row['fullname'];
                    return 1;
                }
                else{
                    $_SESSION['error'] = 'Sai mật khẩu!';
                }
                    
            }
        }


        public function getAllReceiptp(){
            // B1. Khởi tạo kết nối
            $conn = $this->connectDb();
            // B2. Định nghĩa và thực hiện truy vấn
            $sql = "SELECT c.username, r.receiptPID, r.paymentMethod, SUM(d.quantityBuy) AS tongSanPham, SUM(d.total) AS tongTien, r.statusR
            FROM receiptP AS r
            INNER JOIN detailReceiptP AS d ON r.receiptPID = d.receiptPID
            INNER JOIN customers AS c ON r.customerID = c.customerID
            GROUP BY c.username, r.receiptPID, r.statusR";
            $result = mysqli_query($conn,$sql);

            //khai báo biến lưu kết quả trả về (dạng mảng)
            $arr_receipt = [];
            // B3. Xử lý và (KO PHẢI SHOW KẾT QUẢ) TRẢ VỀ KẾT QUẢ
            if(mysqli_num_rows($result) > 0){
                // Lấy tất cả dùng mysqli_fetch_all
                $arr_receipt = mysqli_fetch_all($result, MYSQLI_ASSOC); //Sử dụng MYSQLI_ASSOC để chỉ định lấy kết quả dạng MẢNG KẾT HỢP
            }
           
            return $arr_receipt;
        }

        public function confirmReceiptp($id,$empID){
            // B1. Khởi tạo kết nối
            $conn = $this->connectDb();
            // B2. Định nghĩa và thực hiện truy vấn
            $sql = "UPDATE receiptp SET statusR = '1', employeeID = '{$_SESSION['empID']}'  WHERE receiptPID = '{$id}'";
            $result = mysqli_query($conn, $sql);
            $this->closeDb($conn);
            return $result;
        }


        public function refuseReceiptp($id,$empID){
            // B1. Khởi tạo kết nối
            $conn = $this->connectDb();
            // B2. Định nghĩa và thực hiện truy vấn
            $sql = "UPDATE receiptp SET statusR = '2', employeeID = '{$_SESSION['empID']}'   WHERE receiptPID = '{$id}'";
            $result = mysqli_query($conn, $sql);
            $this->closeDb($conn);
            return $result;
        }



        public function getReceiptDetail($id)
        {
            $conn = $this->connectDb();
            $sql = "SELECT d.*,r.*,p.productName,pi.imageURL 
            FROM receiptP AS r
            INNER JOIN detailReceiptP AS d ON r.receiptPID = d.receiptPID
            INNER JOIN customers AS c ON r.customerID = c.customerID
            INNER JOIN products AS p ON d.productID= p.productID
            INNER JOIN product_image AS pi ON p.productID=pi.productID
            WHERE r.receiptPID = '{$id}' ";
            $result = mysqli_query($conn,$sql);
            // Lấy chi tiết đơn hàng
            
            $receiptDetail = [];
            // B3. Xử lý và (KO PHẢI SHOW KẾT QUẢ) TRẢ VỀ KẾT QUẢ
            if(mysqli_num_rows($result) > 0){
                // Lấy tất cả dùng mysqli_fetch_all
                $receiptDetail = mysqli_fetch_all($result, MYSQLI_ASSOC); //Sử dụng MYSQLI_ASSOC để chỉ định lấy kết quả dạng MẢNG KẾT HỢP
            }
            
            $this->closeDb($conn);
            return $receiptDetail;
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
