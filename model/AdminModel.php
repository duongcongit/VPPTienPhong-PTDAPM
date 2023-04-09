<?php
    require_once './../config/constants.php';

    class AdminModel{
        private $employeeID;
        private $fullname;
        private $gender;
        private $address;
        private $phone;
        private $email;
        private $username;
        private $password;
        private $status;


        // --------------Employee----------------------
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
        

        //Hàm thêm nhân viên
        public function insertEmployee($arr = []) {
            $connection = $this->connectDb();
            $sql_add_employee = "INSERT INTO employees (employeeID, fullname, gender,address, phone, email,username,password,status) VALUES ('{$arr['employeeID']}', '{$arr['employeeName']}', '{$arr['employeeGender']}', '{$arr['employeeAddress']}','{$arr['employeePhone']}', '{$arr['employeeEmail']}','{$arr['employeeUsername']}','{$arr['employeePass']}',1);";
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


        //-------Supplier---------------------
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
        public function getSupplierById($id = null){
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
        public function deleteAllSupplier() {
            $connection = $this->connectDb();
            $queryDelete = "DELETE FROM suppliers";
            $isDelete = mysqli_query($connection, $queryDelete);
            $this->closeDb($connection);      
            return $isDelete;
        }

        
        // Ham xóa NCC
        public function deleteSupplier($id=null) {
            $connection = $this->connectDb();
            $queryDelete = "DELETE FROM suppliers WHERE supplierID = '$id'";
            $isDelete = mysqli_query($connection, $queryDelete);
            $this->closeDb($connection);
                        
            return $isDelete;
        }

        //-----------------END_SUPPLIER-----------------




        //-----Product------
            // Định nghĩa các phương thức để sau này nhận các thao tác tương ứng với các action
            public function getAllProducts(){
                // B1. Khởi tạo kết nối
                $conn = $this->connectDb();
                // B2. Định nghĩa và thực hiện truy vấn
                $sql = "SELECT products.*,categories.name,product_image.imageURL
                FROM products,categories,product_image
                WHERE products.categoryID = categories.categoryID AND products.productID = product_image.productID";
                $result = mysqli_query($conn,$sql);
    
                // Tôi khai báo biến lưu kết quả trả về (dạng mảng)
                $arr_products = [];
                // B3. Xử lý và (KO PHẢI SHOW KẾT QUẢ) TRẢ VỀ KẾT QUẢ
                if(mysqli_num_rows($result) > 0){
                    // Lấy tất cả dùng mysqli_fetch_all
                    $arr_products = mysqli_fetch_all($result, MYSQLI_ASSOC); //Sử dụng MYSQLI_ASSOC để chỉ định lấy kết quả dạng MẢNG KẾT HỢP
                }
                $this->closeDb($conn);
    
                return $arr_products;
            }
    
            // Định nghĩa các phương thức để sau này nhận các thao tác tương ứng với các action
            public function getAllCategory(){
                // B1. Khởi tạo kết nối
                $conn = $this->connectDb();
                // B2. Định nghĩa và thực hiện truy vấn
                $sql = "SELECT *
                FROM categories";
                $result = mysqli_query($conn,$sql);
            
                // Tôi khai báo biến lưu kết quả trả về (dạng mảng)
                $arr_categories = [];
                // B3. Xử lý và (KO PHẢI SHOW KẾT QUẢ) TRẢ VỀ KẾT QUẢ
                if(mysqli_num_rows($result) > 0){
                    // Lấy tất cả dùng mysqli_fetch_all
                    $arr_categories = mysqli_fetch_all($result, MYSQLI_ASSOC); //Sử dụng MYSQLI_ASSOC để chỉ định lấy kết quả dạng MẢNG KẾT HỢP
                }
                $this->closeDb($conn);
                return $arr_categories;
            }
    
            public function insertProduct($arr = []) {
                $connection = $this->connectDb();
                $sql_add_product = "INSERT INTO products (productID, productSKU, productName, categoryID, detail, price, stock, sold, status) VALUES (NULL, '$prodSKU', '$prodName', '$prodCategory', '$prodDetail', '$prodPrice', '$prodStock', '$prodSold', '$prodStatus');";
                $insert_product = mysqli_query($connection,$sql_add_product);
                $this->closeDb($connection);
                return $insert_product;
            }

        //-------------End____Product-------------------


        //-------Cutomers--------------------
        
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

        //------End_Customer----------------





        //-----------------------------
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