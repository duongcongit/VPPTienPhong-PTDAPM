<?php
    require_once _DIR_ROOT.'/app/config/constants.php';

    class EmployeeModel{
        private $receiptPID;
        private $customerID;
        private $productID;
        private $username;
        private $productName;
        private $imageID;
        private $quantityBuy;
        private $total;
        private $statusR;
        
        public function getAllReceiptp(){
            // B1. Khởi tạo kết nối
            $conn = $this->connectDb();
            // B2. Định nghĩa và thực hiện truy vấn
            $sql = "SELECT receiptp.receiptPID,receiptp.customerID,detailreceiptp.productID,customers.username,products.productName,product_image.imageID,detailreceiptp.quantityBuy, detailreceiptp.total,receiptp.statusR
            FROM receiptp,detailreceiptp,products,customers,product_image WHERE  receiptp.receiptPID = detailreceiptp.receiptPID and receiptp.customerID = customers.customerID and detailreceiptp.productID = products.productID and 
            products.productID = product_image.productID";
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

        public function confirmReceiptp($id){
            // B1. Khởi tạo kết nối
            $conn = $this->connectDb();
            // B2. Định nghĩa và thực hiện truy vấn
            $sql = "UPDATE receiptp SET `statusR` = '1' WHERE receiptPID = '$id'";
            $result = mysqli_query($conn, $sql);
            $this->closeDb($conn);
            return $result;
        }

        public function refuseReceiptp($id){
            // B1. Khởi tạo kết nối
            $conn = $this->connectDb();
            // B2. Định nghĩa và thực hiện truy vấn
            $sql = "UPDATE receiptp SET `statusR` = '2' WHERE receiptPID = '$id'";
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