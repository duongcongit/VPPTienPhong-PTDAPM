<?php
    require_once _DIR_ROOT.'/app/config/constants.php';

    class SupplierModel{
        private $supplierID;
        private $supplierName;
        private $address;
        private $phone;
        private $email;

         //-------ADMIN---------------------
         // Định nghĩa các phương thức để sau này nhận các thao tác tương ứng với các action
         public function getAllSuppliers(){
            // B1. Khởi tạo kết nối
            $conn = $this->connectDb();
            // B2. Định nghĩa và thực hiện truy vấn
            $sql = "SELECT * FROM suppliers";
            $result = mysqli_query($conn,$sql);

            // Tôi khai báo biến lưu kết quả trả về (dạng mảng)
            $arr_suppliers = [];
            // B3. Xử lý và (KO PHẢI SHOW KẾT QUẢ) TRẢ VỀ KẾT QUẢ
            if(mysqli_num_rows($result) > 0){
                // Lấy tất cả dùng mysqli_fetch_all
                $arr_suppliers = mysqli_fetch_all($result, MYSQLI_ASSOC); //Sử dụng MYSQLI_ASSOC để chỉ định lấy kết quả dạng MẢNG KẾT HỢP
            }
            $this->closeDb($conn);

            return $arr_suppliers;
        }

        //Lấy thông tin nhà cung cấp theo ID
        public function getSupplierById($id){
            // B1. Khởi tạo kết nối
            $conn = $this->connectDb();
            // B2. Định nghĩa và thực hiện truy vấn
            $sql = "SELECT * FROM suppliers where supplierID = '$id'";
            $result = mysqli_query($conn,$sql);

            // Tôi khai báo biến lưu kết quả trả về (dạng mảng)
            $supplier = [];
            // B3. Xử lý và (KO PHẢI SHOW KẾT QUẢ) TRẢ VỀ KẾT QUẢ
            if(mysqli_num_rows($result) > 0){
                // Lấy tất cả dùng mysqli_fetch_all
                $suppliers = mysqli_fetch_all($result, MYSQLI_ASSOC); //Sử dụng MYSQLI_ASSOC để chỉ định lấy kết quả dạng MẢNG KẾT HỢP
                $supplier = $suppliers[0];
            }
            $this->closeDb($conn);
 
            return $supplier;
        }

        //Kiểm tra nhà cung cấp đã cung cấp SP chưa
        public function checkSuppliers($id){
            // B1. Khởi tạo kết nối
            $conn = $this->connectDb();
            // B2. Định nghĩa và thực hiện truy vấn
            $sql = "SELECT * FROM suppliers,products WHERE suppliers.supplierID = '$id' AND products.supplierID = '$id' ";
            $result = mysqli_query($conn,$sql);
            // B3. Xử lý và 
            if(mysqli_num_rows($result) > 0){
                $this->closeDb($conn);
                return 1;
            }
            $this->closeDb($conn);

            return 0;
        }

        //Hàm thêm nhà cung cấp 
        public function insertSupplier($arr = []) {
            $connection = $this->connectDb();
            $sql_add_supplier = "INSERT INTO suppliers (supplierID, supplierName, address, phone, email) VALUES (NULL, '{$arr['supplierName']}', '{$arr['supplierAddress']}', '{$arr['supplierPhone']}', '{$arr['supplierEmail']}');";
            $insert_supplier = mysqli_query($connection,$sql_add_supplier);
            $this->closeDb($connection);
            return $insert_supplier;
        }

        //Hàm sửa thông tin nhà cung cấp
        public function updateSupplier($arr = []) {
            $connection = $this->connectDb();
            $queryUpdate = "UPDATE suppliers
        SET `supplierName` = '{$arr['supplierName']}',`address` = '{$arr['supplierAddress']}',`phone` = '{$arr['supplierPhone']}',`email` = '{$arr['supplierEmail']}'
        WHERE `supplierId` = {$arr['supplierId']}";
            $isUpdate = mysqli_query($connection, $queryUpdate);
            $this->closeDb($connection);
    
            return $isUpdate;
        }

        // Ham xóa tất cả NCC
        // public function deleteAllSupplier() {
        //     $connection = $this->connectDb();
        //     $queryDelete = "DELETE FROM suppliers";
        //     $isDelete = mysqli_query($connection, $queryDelete);
        //     $this->closeDb($connection);      
        //     return $isDelete;
        // }

        
        // Ham xóa NCC
        public function deleteSupplier($id=null) {
            $connection = $this->connectDb();
            $queryDelete = "DELETE FROM suppliers WHERE supplierID = '$id'";
            $isDelete = mysqli_query($connection, $queryDelete);
            $this->closeDb($connection);
                        
            return $isDelete;
        }

        //-----------------Hết admin-----------------

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