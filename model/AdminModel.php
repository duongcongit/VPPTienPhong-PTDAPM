<?php
    require_once './../config/constants.php';

    class AdminModel{
        private $adminID;
        private $adminName;
        private $username;
        private $password;

        public function loginProcess($user,$pass){
            $conn = $this->connectDb();
            // B2. Định nghĩa và thực hiện truy vấn
            $sql = "SELECT * FROM admins WHERE username = '$user' AND password = '$pass'";
            $result = mysqli_query($conn,$sql);

            // B3. Xử lý và (KO PHẢI SHOW KẾT QUẢ) TRẢ VỀ KẾT QUẢ
            if(mysqli_num_rows($result) == 1){
                $row = mysqli_fetch_array($result);
                if($pass == $row['password']){
                    $_SESSION['adminID']=$row['adminID'];
                    $_SESSION['adminName'] = $row['adminName'];
                    return 1;
                }
                else{
                    $_SESSION['error'] = 'Sai mật khẩu!';
                }
                    
            }
        }

       

        //-----Product------ 
            // Định nghĩa các phương thức để sau này nhận các thao tác tương ứng với các action
            public function getAllProducts(){
                // B1. Khởi tạo kết nối
                $conn = $this->connectDb();
                // B2. Định nghĩa và thực hiện truy vấn
                $sql = "SELECT products.*,categories.name,product_image.imageURL,product_image.label
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
    

            //Them san pham
            public function insertProduct($arr = []) {
                $connection = $this->connectDb();
                $sql_add_product = "INSERT INTO products (productID, productName, detail,stock, sold, price,status, categoryID,supplierID) VALUES ('{$arr['prodID']}','{$arr['prodName']}', '{$arr['prodDetail']}', '{$arr['prodStock']}', '{$arr['prodSold']}','{$arr['prodPrice']}', '{$arr['prodStatus']}','{$arr['prodCate']}','{$arr['prodSupplierID']}');";
                $insert_product = mysqli_query($connection,$sql_add_product);
                $this->closeDb($connection);
                return $insert_product;
            }

            //Them san pham
            public function insertProductImage($url,$prodID,$imgID,$label) {
                $connection = $this->connectDb();
                $sql_add_product_image = "INSERT INTO product_image (imageID, imageURL, label,productID) VALUES ('$imgID','$url','$label','$prodID');";
                $insert_employee = mysqli_query($connection,$sql_add_product_image);
                $this->closeDb($connection);
                return $insert_employee;
            }

        //-------------End____Product-------------------

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