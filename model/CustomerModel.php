<?php
    require_once './../config/constants.php';

    class CustomerModel{
        private $customerID;
        private $fullname;
        private $address;
        private $phone;
        private $email;
        private $username;
        private $password;
        private $status;

        // Định nghĩa các phương thức để sau này nhận các thao tác tương ứng với các action
        public function getAllCustomers(){
            // B1. Khởi tạo kết nối
            $conn = $this->connectDb();
            // B2. Định nghĩa và thực hiện truy vấn
            $sql = "SELECT * FROM customers";
            $result = mysqli_query($conn,$sql);

            // Tôi khai báo biến lưu kết quả trả về (dạng mảng)
            $arr_customers = [];
            // B3. Xử lý và (KO PHẢI SHOW KẾT QUẢ) TRẢ VỀ KẾT QUẢ
            if(mysqli_num_rows($result) > 0){
                // Lấy tất cả dùng mysqli_fetch_all
                $arr_customers = mysqli_fetch_all($result, MYSQLI_ASSOC); //Sử dụng MYSQLI_ASSOC để chỉ định lấy kết quả dạng MẢNG KẾT HỢP
            }
            $this->closeDb($conn);

            return $arr_customers;
        }

        //Thay đổi status người dùng
        public function changeStatusCustomer($id,$status){
            // B1. Khởi tạo kết nối
            $conn = $this->connectDb();
            // B2. Định nghĩa và thực hiện truy vấn
            $sql = "UPDATE customers SET `status` = '$status' WHERE customerID = '$id'";
            $result = mysqli_query($conn, $sql);
            $this->closeDb($conn);
            return $result;
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