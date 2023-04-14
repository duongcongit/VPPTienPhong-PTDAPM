<?php
    require_once _DIR_ROOT.'/app/config/constants.php';

    class EmployeeModel{
        private $receiptPID;
        private $customerID;
        private $productID;
        private $username;
        private $productName;
        private $imageURL;
        private $quantityBuy;
        private $total;
        private $statusR;
        private $employeeID;
        private $employeeName;
        private $usernameEmp;
        private $password;
        
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
?>